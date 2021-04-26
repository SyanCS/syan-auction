<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AutoBids Controller
 *
 * @property \App\Model\Table\AutoBidsTable $AutoBids
 * @method \App\Model\Entity\AutoBid[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AutoBidsController extends AppController
{
   public function save($bidAmount)
    {
        $identity = $this->Authentication->getIdentity();
        $userId = $identity->get('id');

        $autoBid =$this->AutoBids->findByUserId($userId)->first();

        if(!$autoBid){
            $autoBid = $this->AutoBids->newEntity(
                [
                    'user_id' => $identity->get('id'),
                    'amount'  => $bidAmount
                ]
            );
        } else {
            $autoBid->amount = $bidAmount;
        }

        if ($this->AutoBids->save($autoBid)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'autoBid' => $autoBid,
        ]);
        $this->viewBuilder()->setOption('serialize', ['autoBid', 'message']);
    }

    public function getUserAutoBid($userId)
    {
        $autoBid = $this->AutoBids->findByUserId($userId)->first();
        $this->set('autoBid', $autoBid);
        $this->viewBuilder()->setOption('serialize', ['autoBid']);
    }
}
