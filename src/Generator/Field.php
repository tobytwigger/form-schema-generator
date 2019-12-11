<?php

namespace FormSchema\Generator;

use FormSchema\Fields\InputField;
use FormSchema\Schema\Field as FieldSchema;

class Field
{
    /**
     * @var FieldSchema
     */
    private $field;

    public function __construct(FieldSchema $field)
    {
        $this->field = $field;
    }

    /**
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
        $instance = new static($field);
        return $instance;
    }

    /**
     * @param string $model
     * @return Field
     * @throws \Exception
     */
    public static function input(string $model)
    {
        return static::make(InputField::class, $model);
    }

    public function __call($name, $arguments)
    {
        $this->field->{$name}($arguments[0]);
        return $this;
    }

    public function getSchema()
    {
        return $this->field;
    }

}