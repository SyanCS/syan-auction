<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\FactoryLocator;

/**
 * AutoBidsItems Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\AuctionItemsTable&\Cake\ORM\Association\BelongsTo $AuctionItems
 *
 * @method \App\Model\Entity\AutoBidsItem newEmptyEntity()
 * @method \App\Model\Entity\AutoBidsItem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AutoBidsItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AutoBidsItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\AutoBidsItem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AutoBidsItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AutoBidsItem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AutoBidsItem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AutoBidsItem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AutoBidsItem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AutoBidsItem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AutoBidsItem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AutoBidsItem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AutoBidsItemsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('auto_bids_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('AuctionItems', [
            'foreignKey' => 'item_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['item_id'], 'AuctionItems'), ['errorField' => 'item_id']);

        return $rules;
    }

    public function toggleAutoBids($itemAuctionId,$bid)
    {
        $BidsTable      = FactoryLocator::get('Table')->get('Bids');

        $competitors = $this->getAutoBidItemCompetitors($itemAuctionId,$bid);

        $winner = null;
        $secondPlace = null;
        foreach ($competitors as $key => $competitor) {

            if(!$winner){
                $winner = $competitor;
                continue;
            }

            if($winner['available'] < $competitor['available'] ){
                $secondPlace = $winner;
                $winner = $competitor;
                continue;
            }

            if(!$secondPlace){
                $secondPlace = $competitor;
                continue;
            }

            if($secondPlace['available'] < $competitor['available'] ){
                $secondPlace = $competitor;
                continue;
            }

        }

        $newBidAmount = 0;

        if($winner && $winner['available'] <= $bid) return;

        if($secondPlace && $secondPlace['available'] > $bid) {
            $newBidAmount = $secondPlace['available'] + 1;
        }

        $newBidAmount = $bid + 1;

        //removing the posterior current_bid
        $query = $BidsTable->query();
            $query->update()
                ->set(['current_bid' => 0])
                ->where(['item_id' => $itemAuctionId])
                ->execute();

        $bid = $BidsTable->newEntity(
            [
                'user_id' => $winner['user_id'],
                'item_id' => $itemAuctionId,
                'amount'  => $newBidAmount,
                'auto_bid' => 1,
                'current_bid' => 1
            ]
        );

        $BidsTable->save($bid);

        return;
    }


    private function getAutoBidItemCompetitors($itemAuctionId)
    {
        $BidsTable      = FactoryLocator::get('Table')->get('Bids');
        $AutoBidsTable  = FactoryLocator::get('Table')->get('AutoBids');

        $autoBidsItems = 
            $this
            ->findByItemId($itemAuctionId);

        $competitors = [];
        $i = 0;
        foreach ($autoBidsItems as $key => $autoBidItem) {
            $competitors[$i]['user_id'] =  $autoBidItem->user_id;

            $query = $BidsTable->find('all')->contain(['AuctionItems']);

            $competitors[$i]['used_amount'] = 
                $query
                ->select(['used' => $query->func()->sum('amount')])
                ->where(
                    ['user_id' => $autoBidItem->user_id, 
                    'auto_bid' => 1, 
                    'AuctionItems.status' => 'ACTIVE', 
                    'current_bid' => 1]
                )
                ->first()
                ->used;
            $competitors[$i]['max_amount'] = $AutoBidsTable->findByUserId($autoBidItem->user_id)->first()->amount;
            $competitors[$i]['available'] = $competitors[$i]['max_amount'] - $competitors[$i]['used_amount'];

            $i++;          
        }

        return $competitors;
    }
}
