<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AutoBidsItems Controller
 *
 * @property \App\Model\Table\AutoBidsItemsTable $AutoBidsItems
 * @method \App\Model\Entity\AutoBidsItemsItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AutoBidsItemsController extends AppController
{
    public function save($itemId)
    {
        $identity = $this->Authentication->getIdentity();
        $userId = $identity->get('id');
        $message = 'Saved';

        $autoBidItem = 
            $this->AutoBidsItems->find('all')
            ->where(['user_id ' => $userId, 'item_id' => $itemId])
            ->first();

        if(!$autoBidItem){
            $autoBidItem = $this->AutoBidsItems->newEntity(
                [
                    'user_id' => $identity->get('id'),
                    'item_id'  => $itemId
                ]
            );
            if ($this->AutoBidsItems->save($autoBidItem)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
        } 

        
        $this->set([
            'message' => $message,
            'autoBidItem' => $autoBidItem,
        ]);
        $this->viewBuilder()->setOption('serialize', ['autoBidItem', 'message']);
    }

    public function delete($itemId)
    {
        $identity = $this->Authentication->getIdentity();
        $userId = $identity->get('id');

        $this->request->allowMethod(['delete']);

        $autoBidItem = 
            $this->AutoBidsItems->find('all')
            ->where(['user_id ' => $userId, 'item_id' => $itemId])
            ->first();

        $message = 'Deleted';
        if (!$this->AutoBidsItems->delete($autoBidItem)) {
            $message = 'Error';
        }
        $this->set('message', $message);
        $this->viewBuilder()->setOption('serialize', ['message']);
    }

    public function getLoggedUserItemAutoBid($itemId)
    {
        $identity = $this->Authentication->getIdentity();
        $userId = $identity->get('id');
        $message = 'Saved';

        $autoBidItem = 
            $this->AutoBidsItems->find('all')
            ->where(['user_id ' => $userId, 'item_id' => $itemId])
            ->first();
        
        $this->set([
            'autoBidItem' => $autoBidItem,
        ]);
        $this->viewBuilder()->setOption('serialize', ['autoBidItem']);
    }
}
