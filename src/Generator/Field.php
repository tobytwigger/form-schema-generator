<?php

namespace FormSchema\Generator;

use FormSchema\Fields\CheckboxField;
use FormSchema\Fields\CheckListField;
use FormSchema\Fields\InputField;
use FormSchema\Fields\LabelField;
use FormSchema\Fields\RadiosField;
use FormSchema\Fields\SelectField;
use FormSchema\Fields\SubmitField;
use FormSchema\Fields\TextAreaField;
use FormSchema\Schema\Field as FieldSchema;

/**
 * Helper to generate a field schema
 *
 * @method self type(?string $type) Get/set the field type
 * @method self label(?string $type) Get/set the label of the field.
 * @method self model(?string $type) Get/set the model of the field. This is the key to refer to the form with
 * @method self id(?string $type) Get/set the id attribute of the field
 * @method self inputName(?string $type) Get/set the name attribute of the field
 * @method self featured(?bool $type) Get/set if the field is featured
 * @method self visible(?bool $type) Get/set if the field is visible
 * @method self disabled(?bool $type) Get/set if the field is disabled
 * @method self required(?bool $type) Get/set if the field is required
 * @method self multi(?bool $type) Get/set if the field should be visible ONLY if the field is of type multiple
 * @method self default(?mixed $type) Get/set the default value of the field
 * @method self hint(?string $type) Get/set the hint associated with the field
 * @method self help(?string $type) Get/set the tooltip help associated with the field
 * @method self styleClasses(?string|array $type) Get/set the additional style classes to be associated with the field
 * @method self buttons(?string $type) Get/set button functions
 * @method self attributes(?array $type) Get/set the attributes of the field. These are split into...
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
    public static function make(string $fieldType, string $model)
    {
        if(is_subclass_of($fieldType, FieldSchema::class)) {
            $field = new $fieldType;
        } else {
            throw new \Exception(sprintf('The field type must be a class extending FieldSchema, %s given', $fieldType));
        }
        $field->model($model);
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