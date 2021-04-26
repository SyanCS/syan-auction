<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AuctionItems Controller
 *
 * @property \App\Model\Table\AuctionItemsTable $AuctionItems
 * @method \App\Model\Entity\AuctionItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AuctionItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $auctionItems = $this->AuctionItems->find('all');

        $this->set('auctionItems', $auctionItems);
        $this->viewBuilder()->setOption('serialize', ['auctionItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Auction Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $auctionItem = $this->AuctionItems->get($id, [
            'contain' => [],
        ]);

        $this->set('auctionItem', $auctionItem);
        $this->viewBuilder()->setOption('serialize', ['auctionItem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $auctionItem = $this->AuctionItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $auctionItem = $this->AuctionItems->patchEntity($auctionItem, $this->request->getData());
            if ($this->AuctionItems->save($auctionItem)) {
                $this->Flash->success(__('The auction item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The auction item could not be saved. Please, try again.'));
        }
        $this->set(compact('auctionItem'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Auction Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $auctionItem = $this->AuctionItems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $auctionItem = $this->AuctionItems->patchEntity($auctionItem, $this->request->getData());
            if ($this->AuctionItems->save($auctionItem)) {
                $this->Flash->success(__('The auction item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The auction item could not be saved. Please, try again.'));
        }
        $this->set(compact('auctionItem'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Auction Item id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $auctionItem = $this->AuctionItems->get($id);
        if ($this->AuctionItems->delete($auctionItem)) {
            $this->Flash->success(__('The auction item has been deleted.'));
        } else {
            $this->Flash->error(__('The auction item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
