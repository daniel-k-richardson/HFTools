<?php
namespace App\Controller;

/**
 * Runs Controller
 *
 * @property \App\Model\Table\RunsTable $Runs
 */
class RunsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Days']
        ];
        $runs = $this->paginate($this->Runs);

        $this->set(compact('runs'));
        $this->set('_serialize', ['runs']);
    }

    /**
     * View method
     *
     * @param string|null $id Run id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $run = $this->Runs->get($id, [
            'contain' => ['Days', 'Observations']
        ]);

        $this->set('run', $run);
        $this->set('_serialize', ['run']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $run = $this->Runs->newEntity();
        if ($this->request->is('post')) {
            $run = $this->Runs->patchEntity($run, $this->request->data);
            if ($this->Runs->save($run)) {
                $this->Flash->success(__('The run has been saved.'));

                return $this->redirect($this->Auth->redirectUrl('/users/home'));
            }
            $this->Flash->error(__('The run could not be saved. Please, try again.'));
        }
        $days = $this->Runs->Days->find('list', ['limit' => 200]);
        $this->set(compact('run', 'days'));
        $this->set('_serialize', ['run']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Run id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $run = $this->Runs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $run = $this->Runs->patchEntity($run, $this->request->data);
            if ($this->Runs->save($run)) {
                $this->Flash->success(__('The run has been saved.'));

                return $this->redirect($this->Auth->redirectUrl('/users/home'));
            }
            $this->Flash->error(__('The run could not be saved. Please, try again.'));
        }
        $days = $this->Runs->Days->find('list', ['limit' => 200]);
        $this->set(compact('run', 'days'));
        $this->set('_serialize', ['run']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Run id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $run = $this->Runs->get($id);
        if ($this->Runs->delete($run)) {
            $this->Flash->success(__('The run has been deleted.'));
        } else {
            $this->Flash->error(__('The run could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
