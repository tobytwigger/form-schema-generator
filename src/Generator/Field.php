<?php

namespace FormSchema\Generator;

use FormSchema\Fields\CheckboxField;
use FormSchema\Fields\CheckListField;
use FormSchema\Fields\InputField;
use FormSchema\Fields\LabelField;
use FormSchema\Fields\RadiosField;
use FormSchema\Fields\SelectField;
use FormSchema\Fields\SubmitField;
use FormSchema\Fields\SwitchField;
use FormSchema\Fields\TextAreaField;
use FormSchema\Schema\Field as FieldSchema;

/**
 * Helper to generate a field schema
 *
 * @package FormSchema\Generator
 */
class Field
{
    /**
     * Holds a reference to the field schema model
     *
     * @var FieldSchema
     */
    private $field;

    /**
     * @param FieldSchema $field
     */
    public function __construct(FieldSchema $field)
    {
        $this->field = $field;
    }

    /**
     * Create a new FieldGenerator instance.
     *
     * @param string $fieldType
     * @param string $model
     * @return Field
     * @throws \Exception
     */
    public static function make(string $fieldType, string $id)
    {
        if(is_subclass_of($fieldType, FieldSchema::class)) {
            $field = new $fieldType;
        } else {
            throw new \Exception(sprintf('The field type must be a class extending FieldSchema, %s given', $fieldType));
        }
        $field->setId($id);
        return new static($field);
    }

    /**
     * Create an input field
     *
     * @param string $model
     * @return Field
     * @throws \Exception
     */
    public static function input(string $model)
    {
        return static::make(InputField::class, $model);
    }

    /**
     * Create an checkbox field
     *
     * @param string $model
     * @return Field
     * @throws \Exception
     */
    public static function checkBox(string $model)
    {
        return static::make(CheckboxField::class, $model);
    }

    /**
     * Create an checklist field
     *
     * @param string $model
     * @return Field
     * @throws \Exception
     */
    public static function checkList(string $model)
    {
        return static::make(CheckListField::class, $model);
    }

    /**
     * Create an label field
     *
     * @param string $model
     * @return Field
     * @throws \Exception
     */
    public static function labels(string $model)
    {
        return static::make(LabelField::class, $model);
    }

    /**
     * Create an radios field
     *
     * @param string $model
     * @return Field
     * @throws \Exception
     */
    public static function radios(string $model)
    {
        return static::make(RadiosField::class, $model);
    }

    /**
     * Create an select field
     *
     * @param string $model
     * @return Field
     * @throws \Exception
     */
    public static function select(string $model)
    {
        return static::make(SelectField::class, $model);
    }

    /**
     * Create an submit field
     *
     * @param string $model
     * @return Field
     * @throws \Exception
     */
    public static function submit(string $model)
    {
        return static::make(SubmitField::class, $model);
    }

    /**
     * Create an textarea field
     *
     * @param string $model
     * @return Field
     * @throws \Exception
     */
    public static function textArea(string $model)
    {
        return static::make(TextAreaField::class, $model);
    }

    /**
     * Create a switch field
     *
     * @param string $model
     * @return Field
     * @throws \Exception
     */
    public static function switch(string $model)
    {
        return static::make(SwitchField::class, $model);
    }

    /**
     * Dynamically forward method calls to the schema object
     *
     * @param string $name
     * @param array $arguments
     * @return $this Allow for method chaining
     */
    public function __call($name, $arguments)
    {
        $this->field->{$name}($arguments[0]);
        return $this;
    }

    /**
     * Get the underlying field schema object
     *
     * @return FieldSchema
     */
    public function getSchema()
    {
        return $this->field;
    }

}
