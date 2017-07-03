<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Buttontypes Controller
 *
 * @property \App\Model\Table\ButtontypesTable $Buttontypes
 *
 * @method \App\Model\Entity\Buttontype[] paginate($object = null, array $settings = [])
 */
class ButtontypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $buttontypes = $this->paginate($this->Buttontypes);

        $this->set(compact('buttontypes'));
        $this->set('_serialize', ['buttontypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Buttontype id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $buttontype = $this->Buttontypes->get($id, [
            'contain' => ['Buttonvalues']
        ]);

        $this->set('buttontype', $buttontype);
        $this->set('_serialize', ['buttontype']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $buttontype = $this->Buttontypes->newEntity();
        if ($this->request->is('post')) {
            $buttontype = $this->Buttontypes->patchEntity($buttontype, $this->request->getData());
            if ($this->Buttontypes->save($buttontype)) {
                $this->Flash->success(__('The buttontype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The buttontype could not be saved. Please, try again.'));
        }
        $buttonvalues = $this->Buttontypes->Buttonvalues->find('list', ['limit' => 200]);
        $this->set(compact('buttontype', 'buttonvalues'));
        $this->set('_serialize', ['buttontype']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Buttontype id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $buttontype = $this->Buttontypes->get($id, [
            'contain' => ['Buttonvalues']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $buttontype = $this->Buttontypes->patchEntity($buttontype, $this->request->getData());
            if ($this->Buttontypes->save($buttontype)) {
                $this->Flash->success(__('The buttontype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The buttontype could not be saved. Please, try again.'));
        }
        $buttonvalues = $this->Buttontypes->Buttonvalues->find('list', ['limit' => 200]);
        $this->set(compact('buttontype', 'buttonvalues'));
        $this->set('_serialize', ['buttontype']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Buttontype id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $buttontype = $this->Buttontypes->get($id);
        if ($this->Buttontypes->delete($buttontype)) {
            $this->Flash->success(__('The buttontype has been deleted.'));
        } else {
            $this->Flash->error(__('The buttontype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}