<?php
namespace lrnzfrr\CustomFields\Model\Traits;

/**
 * CustomField Trait
 *
*/
trait CustomFieldTrait
{
    /**
     * Return an associative Array of CustomFields
     * @return array assoc Array custom fields
     */
    public function getCustomFieldsAssoc()
    {
        $customFieldsAssoc = [];
        if ($this->custom_fields) {
            foreach ($this->custom_fields as $customField) {
                $customFieldsAssoc[$customField->name] = $customField->value;
            }
        }

        return $customFieldsAssoc;
    }
}
