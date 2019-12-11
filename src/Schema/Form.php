<?php

namespace FormSchema\Schema;

class Form {

    private $groups = [];
    
    private $fields = [];
    
    public function addGroup(Group $group)
    {
        $this->groups[] = $group;
    }

    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }

    public function fields()
    {
        return $this->fields;
    }

    public function groups()
    {
        return $this->groups;
    }
    
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
    
    public function toJson()
    {
        return json_encode($this->toArray());
    }
    
    public function __toString()
    {
        return $this->toJson();
    }
    
}