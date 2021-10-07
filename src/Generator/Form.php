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
    public static function make(?string $title = null, ?string $subtitle = null, ?string $description = null)
    {
        $formSchema = new FormSchema();
        if($title) {
            $formSchema->setTitle($title);
        }
        if($subtitle) {
            $formSchema->setSubtitle($subtitle);
        }
        if($description) {
            $formSchema->setDescription($description);
        }
        return new static($formSchema);
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
     * @param \FormSchema\Schema\Field $field
     * @return $this
     */
    public function withField(\FormSchema\Schema\Field $field)
    {
        $group = new \FormSchema\Schema\Group();
        $group->addField($field);
        $this->form->addGroup($group);
        return $this;
    }

    /**
     * Automatically return the form as JSON when requested
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return $this->getSchema()->toJson();
    }

    public function toArray(): array
    {
        return $this->getSchema()->toArray();
    }

    public function form(): FormSchema
    {
        return $this->getSchema();
    }

    public function cast()
    {
        return form($this->getSchema());
    }

    /**
     * Get the underlying schema instance
     *
     * @return FormSchema
     */
    public function getSchema(): FormSchema
    {
        return $this->form;
    }

}
