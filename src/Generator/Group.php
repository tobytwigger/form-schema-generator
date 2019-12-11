<?php

namespace FormSchema\Generator;

use FormSchema\Schema\Field as FieldSchema;
use FormSchema\Schema\Group as GroupSchema;

class Group
{

    private $group;

    public function __construct(GroupSchema $group)
    {
        $this->group = $group;
    }

    public static function make()
    {
        return new static(new GroupSchema);
    }
    
    public function legend(string $legend)
    {
        $this->group->setLegend($legend);
        return $this;
    }

    public function withField(Field $field)
    {
        $this->group->addField($field->getSchema());
        return $this;
    }
    
    
    public function getSchema()
    {
        return $this->group;
    }

}