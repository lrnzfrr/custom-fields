<?php
namespace lrnzfrr\CustomFields\Model\Behavior;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Cake\Utility\Text;
use Cake\ORM\Table;
use Cake\ORM\Entity;

class CustomFieldableBehavior extends Behavior
{

    protected $_defaultConfig = [
        'fkTableField' => 'fk_table',
        'fkId' => 'fk_id',
        'associationClass' => 'lrnzfrr/CustomFields.CustomFields',
        'associationAlias' => 'CustomFields',
        'connection_key' => 'table',
        'accessibleFields' => '*'
        ];

    /**
     * Initialize configuration.
     *
     * @param array $config Configuration array.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->bindAssociations();
    }

    /**
     * Binds all required associations if an association of the same name has
     * not already been configured.
     * @return void
     */
    public function bindAssociations()
    {
        $table = $this->_table;
        if ($this->getConfig('connection_key') == 'table') {
            $connection_key = $table->getTable();
        } else {
            $connection_key = $this->getConfig('connection_key');
        }

        $tableAlias = $this->_table->getAlias();
        if (!$table->hasAssociation($this->getConfig('associationAlias'))) {
            $table->hasMany($this->getConfig('associationAlias'), [
                                            'dependent'  => true,
                                            'cascadeCallbacks' => true,
                                            'foreignKey' => $this->getConfig('fkId'),
                                            'className'  => $this->getConfig('associationClass'),
                                            'conditions' => [$this->getConfig('associationAlias'). '.' . $this->getConfig('fkTableField') => $connection_key,

                                                            ] ]);
        }
    }

    /**
     * Set the custom fields that can be added / modified
     *
     * @param event Event object
     * @param entity Entity object
     * @param options Array options
     * @return entity Entity object
     */
    public function beforeSave($event, $entity, $options)
    {
        if ($this->getConfig('accessibleFields') == '*') {
            return $entity;
        }
        $accessibleFields = $this->getConfig('accessibleFields');
        $customFieldsProperty = Inflector::tableize($this->getConfig('associationAlias'));

        if (isset($entity[$customFieldsProperty])) {
            foreach ($entity[$customFieldsProperty] as $k => $v) {
                $entity[$customFieldsProperty][$k]['fk_table'] = $this->_table->getTable();
                if (!in_array($v['name'], $accessibleFields)) {
                    unset($entity[$customFieldsProperty][$k]);
                }
            }
        }

        return $entity;
    }

    /**
     * Finder withCustomFields
     * @param object $query query object
     * @param array $options array option
     * @return $query
     */
    public function findWithCustomFields(Query $query, array $options)
    {
        return $query->contain($this->getConfig('associationAlias'));
    }
}
