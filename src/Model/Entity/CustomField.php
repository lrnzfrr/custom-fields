<?php
namespace lrnzfrr\CustomFields\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomField Entity
 *
 * @property int $id
 * @property int|null $fk_id
 * @property string|null $fk_table
 * @property string|null $name
 * @property string|null $value
 *
 * @property \App\Model\Entity\Fk $fk
 */
class CustomField extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'fk_id' => true,
        'fk_table' => true,
        'name' => true,
        'value' => true,
        'fk' => true
    ];
}
