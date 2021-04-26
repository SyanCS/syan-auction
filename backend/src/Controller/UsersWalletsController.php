<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * UsersWallets Controller
 *
 * @property \App\Model\Table\UsersWalletsTable $UsersWallets
 * @method \App\Model\Entity\UsersWallet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersWalletsController extends AppController
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
        $usersWallets = $this->paginate($this->UsersWallets);

        $this->set(compact('usersWallets'));
    }

    /**
     * View method
     *
     * @param string|null $id Users Wallet id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersWallet = $this->UsersWallets->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('usersWallet'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersWallet = $this->UsersWallets->newEmptyEntity();
        if ($this->request->is('post')) {
            $usersWallet = $this->UsersWallets->patchEntity($usersWallet, $this->request->getData());
            if ($this->UsersWallets->save($usersWallet)) {
                $this->Flash->success(__('The users wallet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users wallet could not be saved. Please, try again.'));
        }
        $users = $this->UsersWallets->Users->find('list', ['limit' => 200]);
        $this->set(compact('usersWallet', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Wallet id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersWallet = $this->UsersWallets->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersWallet = $this->UsersWallets->patchEntity($usersWallet, $this->request->getData());
            if ($this->UsersWallets->save($usersWallet)) {
                $this->Flash->success(__('The users wallet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users wallet could not be saved. Please, try again.'));
        }
        $users = $this->UsersWallets->Users->find('list', ['limit' => 200]);
        $this->set(compact('usersWallet', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Wallet id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersWallet = $this->UsersWallets->get($id);
        if ($this->UsersWallets->delete($usersWallet)) {
            $this->Flash->success(__('The users wallet has been deleted.'));
        } else {
            $this->Flash->error(__('The users wallet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
