<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Shippings Model
 *
 * @property \App\Model\Table\ZonesTable&\Cake\ORM\Association\BelongsTo $Zones
 *
 * @method \App\Model\Entity\Shipping newEmptyEntity()
 * @method \App\Model\Entity\Shipping newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Shipping[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Shipping get($primaryKey, $options = [])
 * @method \App\Model\Entity\Shipping findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Shipping patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Shipping[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Shipping|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Shipping saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Shipping[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Shipping[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Shipping[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Shipping[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ShippingsTable extends Table
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

        $this->setTable('shippings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Zones', [
            'foreignKey' => 'zone_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');
        $validator
            ->integer('zone_id')
            ->greaterThanOrEqual('zone_id', 0)
            ->requirePresence('zone_id', 'create')
            ->notEmptyString('zone_id',  'Please enter another postcode');

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 5)
            ->minLength('postcode', 5, 'Postcode is a 5-digit number.')
            ->numeric('postcode', 'Postcode is a 5-digit number.')
            ->requirePresence('postcode', 'create')
            ->notEmptyString('postcode');

        $validator
            ->decimal('total_order_amount')
            ->greaterThanOrEqual('total_order_amount', 0)
            ->requirePresence('total_order_amount', 'create')
            ->notEmptyString('total_order_amount');

        $validator
            ->decimal('shipping_order_amount')
            ->greaterThanOrEqual('shipping_order_amount', 0)
            ->requirePresence('shipping_order_amount', 'create')
            ->notEmptyString('shipping_order_amount');

        $validator
            ->boolean('long_product')
            ->allowEmptyString('long_product');
         
        


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
        $rules->add($rules->existsIn(['zone_id'], 'Zones'), ['errorField' => 'zone_id']);

        return $rules;
    }
    
}
