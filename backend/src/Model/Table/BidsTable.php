<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bids Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\AuctionItemsTable&\Cake\ORM\Association\BelongsTo $AuctionItems
 *
 * @method \App\Model\Entity\Bid newEmptyEntity()
 * @method \App\Model\Entity\Bid newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Bid[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bid get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bid findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Bid patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bid[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bid|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bid saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bid[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bid[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bid[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bid[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BidsTable extends Table
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

        $this->setTable('bids');
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

        $validator
            ->decimal('amount')
            ->greaterThanOrEqual('amount', 0)
            ->requirePresence('amount', 'create')
            ->notEmptyString('amount');

        $validator
            ->boolean('auto_bid')
            ->allowEmptyString('auto_bid');

        $validator
            ->boolean('current_bid')
            ->notEmptyString('current_bid');

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

    public function getItemHighestBid($itemAuctionId)
    {
        return 
            $this->find('all')
            ->order(['amount' => 'DESC'])
            ->first();
    }
}
