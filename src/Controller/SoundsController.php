<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Sounds Controller
 *
 * @property \App\Model\Table\SoundsTable $Sounds
 * @method \App\Model\Entity\Sound[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SoundsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $sounds = $this->paginate($this->Sounds);

        $this->set(compact('sounds'));
    }

    /**
     * View method
     *
     * @param string|null $id Sound id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sound = $this->Sounds->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('sound'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sound = $this->Sounds->newEmptyEntity();
        if ($this->request->is('post')) {
            $sound = $this->Sounds->patchEntity($sound, $this->request->getData());
            if ($this->Sounds->save($sound)) {
                $this->Flash->success(__('The sound has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sound could not be saved. Please, try again.'));
        }
        $users = $this->Sounds->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('sound', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sound id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sound = $this->Sounds->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sound = $this->Sounds->patchEntity($sound, $this->request->getData());
            if ($this->Sounds->save($sound)) {
                $this->Flash->success(__('The sound has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sound could not be saved. Please, try again.'));
        }
        $users = $this->Sounds->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('sound', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sound id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sound = $this->Sounds->get($id);
        if ($this->Sounds->delete($sound)) {
            $this->Flash->success(__('The sound has been deleted.'));
        } else {
            $this->Flash->error(__('The sound could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
