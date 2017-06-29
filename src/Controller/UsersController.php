<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Allow users to login before gaining access to the site.
     *
     * @return \Cake\Network\Response|null
     */
    /**
     * Allow users to login before gaining access to the site.
     *
     * @return \Cake\Network\Response|null
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                if ($this->Auth->user('role') == 'admin') {
                    $this->set('role', $this->Auth->user('role'));
                    return $this->redirect(['controller' => 'users']);
                }
                return $this->redirect(['action' => 'home']);
            }
            $this->Flash->error('Incorrect Login');
        }
    }

    function logout()
    {
        $this->redirect($this->Auth->logout());
    }

    /***
     * This is the landing page once a user logs in.
     */
    public function home()
    {
        $this->loadModel('Sessions');
        $this->loadModel('Runs');

        $client_id = $this->Auth->user('client_id');
        $current_session = null;
        $current_run = null;

        if ($client_id != null) {
            $current_session = $this->Sessions->find()
                ->where(['client_id' => $client_id])
                ->andwhere(['start_date <=' => date('Y-m-d')])
                ->andwhere(['end_date >=' => date('Y-m-d')])->first();
        }

//        $current_day = null;
//        if ($current_session != null) {
//            $current_day = $this->Days->find()
//                ->where(['session_id =' . $current_session['id']])
//                ->andwhere(['DATE(day_date) =' => date('Y-m-d')])->first();
//        }


        if ($current_session != null) {
            $current_run = $this->Runs->find()
                ->where(['session_id = ' => $current_session['id']])
                ->andwhere(['DATE(run_date) =' => date('Y-m-d')])->first();
                //->andwhere(['is_open = ' => true])->first();
        }

        $this->request->session()->write('Current', ['session' => $current_session, 'run' => $current_run]);

        if ($current_session) {

            if ($current_run) {
                return $this->redirect(
                    ['controller' => 'observations', 'action' => 'create']);
            } else {
                return $this->redirect(
                    ['controller' => 'runs', 'action' => 'add']);
            }
        } else {
            return $this->redirect(
                ['controller' => 'sessions', 'action' => 'add']);
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clients']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Clients']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {

            // confirm the user entered the same password twice
            $password = $this->request->getData(['password']);
            $repassword = $this->request->getData(['re_password']);

            if (strcmp($password, $repassword) == 0) {

                $user = $this->Users->patchEntity($user, $this->request->getData());
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            } else {
                $this->Flash->error(__('Passwords do not match, please try again.'));
            }
        }
        $clients = $this->Users->Clients->find('list', ['limit' => 200]);

        $this->set(compact('user', 'clients'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $clients = $this->Users->Clients->find('list', ['limit' => 200]);
        $this->set(compact('user', 'clients'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
