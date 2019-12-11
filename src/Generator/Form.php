<?php

namespace FormSchema\Generator;

use FormSchema\Generator\Group as GroupGenerator;
use FormSchema\Generator\Field as FieldGenerator;
use FormSchema\Schema\Field as FieldSchema;
use FormSchema\Schema\Form as FormSchema;

class Form
{
    private $form;

    public function __construct(FormSchema $form)
    {
        $this->form = $form;
    }

    public static function make()
    {
        return new static(new FormSchema());
    }

    public function withGroup(GroupGenerator $group)
    {
        $this->form->addGroup($group->getSchema());
        return $this;
    }

    public function withField(FieldGenerator $field)
    {
        $this->form->addField($field->getSchema());
        return $this;
    }

    public function __toString()
    {
        return (string) $this->getSchema();
    }

    public function getSchema()
    {
        return $this->form;
    }

}