<?php

namespace FormSchema\Generator;

use FormSchema\Generator\Group as GroupGenerator;
use FormSchema\Generator\Field as FieldGenerator;
use FormSchema\Schema\Form as FormSchema;

/**
 * Helper to generate a form schema
 * 
 * @package FormSchema\Generator
 */
class Form
{
    /**
     * Holds the form schema instance
     * 
     * @var FormSchema 
     */
    private $form;

    /**
     * @param FormSchema $form
     */
    public function __construct(FormSchema $form)
    {
        $this->form = $form;
    }

    /**
     * Create a new instance of the FormGenerator
     * 
     * @return static
     */
    public static function make()
    {
        return new static(new FormSchema());
    }

    /**
     * Add a group to the form
     * 
     * @param Group $group
     * @return $this
     */
    public function withGroup(GroupGenerator $group)
    {
        $this->form->addGroup($group->getSchema());
        return $this;
    }

    /**
     * Add an ungrouped field to the form
     * 
     * @param Field $field
     * @return $this
     */
    public function withField(FieldGenerator $field)
    {
        $this->form->addField($field->getSchema());
        return $this;
    }

    /**
     * Automatically return the form as JSON when requested
     * 
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getSchema();
    }

    /**
     * Get the underlying schema instance 
     * 
     * @return FormSchema
     */
    public function getSchema()
    {
        return $this->form;
    }

}