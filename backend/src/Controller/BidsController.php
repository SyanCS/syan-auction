<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Bids Controller
 *
 * @property \App\Model\Table\BidsTable $Bids
 * @method \App\Model\Entity\Bid[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BidsController extends AppController
{

    public function bid($bidAmount,$itemAuctionId)
    {
        $this->loadModel('AutoBidsItems');

        $identity = $this->Authentication->getIdentity();

        $highestBid = $this->Bids->getItemHighestBid($itemAuctionId);

        if(!empty($highestBid) && $bidAmount <= $highestBid->amount){
            $message = "Error";
            $this->set([
                'message' => $message
            ]);
            return $this->viewBuilder()->setOption('serialize', ['message']);
        }

        //removing the posterior current_bid
        $query = $this->Bids->query();
            $query->update()
                ->set(['current_bid' => 0])
                ->where(['item_id' => $itemAuctionId])
                ->execute();

        $bid = $this->Bids->newEntity(
            [
                'user_id' => $identity->get('id'),
                'item_id' => $itemAuctionId,
                'amount'  => $bidAmount,
                'current_bid' => 1
            ]
        );

        if ($this->Bids->save($bid)) {
            $this->AutoBidsItems->toggleAutoBids($itemAuctionId,$bidAmount);
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'bid' => $bid,
        ]);
        $this->viewBuilder()->setOption('serialize', ['bid', 'message']);
    }

    public function getItemHighestBid($itemAuctionId)
    {
        $bid = $this->Bids->getItemHighestBid($itemAuctionId);
        $this->set([
            'bid' => $bid,
        ]);
        $this->viewBuilder()->setOption('serialize', ['bid']);
    }

}
