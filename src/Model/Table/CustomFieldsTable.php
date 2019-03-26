<?php
namespace lrnzfrr\CustomFields\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomFields Model
 *
 * @method \App\Model\Entity\CustomField get($primaryKey, $options = [])
 * @method \App\Model\Entity\CustomField newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CustomField[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CustomField|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomField|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomField patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CustomField[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CustomField findOrCreate($search, callable $callback = null, $options = [])
 */
class CustomFieldsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('custom_fields');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('fk_table')
            ->maxLength('fk_table', 100)
            ->allowEmptyString('fk_table');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->allowEmptyString('name');

        $validator
            ->scalar('value')
            ->allowEmptyString('value');

        return $validator;
    }
}
