<?php

namespace FormSchema\Schema;

/**
 * Represents a form
 * @package FormSchema\Schema
 */
class Form {

    /**
     * Hold all groups belonging to this form
     * @var array 
     */
    private $groups = [];

    /**
     * @var array Hold all fields belonging to this form
     */
    private $fields = [];

    /**
     * Add a group to the form
     * 
     * @param Group $group
     */
    public function addGroup(Group $group)
    {
        $this->groups[] = $group;
    }

    /**
     * Add a field to the form
     * 
     * @param Field $field
     */
    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }

    /**
     * Get all fields belonging to the form
     * 
     * @return Field[]
     */
    public function fields()
    {
        return $this->fields;
    }

    /**
     * Get all groups belonging to the form
     * 
     * @return Group[]
     */
    public function groups()
    {
        return $this->groups;
    }

    /**
     * Output the schema representation of this form
     * 
     * @return array
     */
    public function toArray()
    {
        return [
            'fields' => array_map(function(Field $field) {
                return $field->toArray();
            }, $this->fields),
            'groups' => array_map(function(Group $group) {
                return $group->toArray();
            }, $this->groups),
        ];
    }

    /**
     * Return the schema representation of the form as a json string
     * 
     * @return false|string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * Return the schema representation of the form as a json string
     * 
     * @return false|string
     */
    public function __toString()
    {
        return $this->toJson();
    }
    
}