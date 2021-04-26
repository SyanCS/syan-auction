<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AuctionItems Model
 *
 * @method \App\Model\Entity\AuctionItem newEmptyEntity()
 * @method \App\Model\Entity\AuctionItem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AuctionItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AuctionItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\AuctionItem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AuctionItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AuctionItem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AuctionItem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AuctionItem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AuctionItem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AuctionItem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AuctionItem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AuctionItem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AuctionItemsTable extends Table
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

        $this->setTable('auction_items');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('name')
            ->maxLength('name', 30)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('descr')
            ->allowEmptyString('descr');

        $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->requirePresence('image', 'create')
            ->notEmptyFile('image');

        $validator
            ->decimal('minimum_bid')
            ->requirePresence('minimum_bid', 'create')
            ->notEmptyString('minimum_bid');

        $validator
            ->dateTime('ending')
            ->requirePresence('ending', 'create')
            ->notEmptyDateTime('ending');

        $validator
            ->scalar('status')
            ->notEmptyString('status');

        return $validator;
    }
}
