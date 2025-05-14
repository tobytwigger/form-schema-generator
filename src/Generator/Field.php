<?php

namespace FormSchema\Generator;

use Exception;
use FormSchema\Fields\AnonymousField;
use FormSchema\Fields\ArrayField;
use FormSchema\Fields\CheckboxField;
use FormSchema\Fields\CheckListField;
use FormSchema\Fields\FileUploadField;
use FormSchema\Fields\HtmlField;
use FormSchema\Fields\NumberField;
use FormSchema\Fields\RadiosField;
use FormSchema\Fields\SelectField;
use FormSchema\Fields\SwitchField;
use FormSchema\Fields\TagField;
use FormSchema\Fields\TextAreaField;
use FormSchema\Fields\TextInputField;
use FormSchema\Fields\EmailField;
use FormSchema\Schema\Field as FieldSchema;

/**
 * Helper to generate a field schema
 *
 * @package FormSchema\Generator
 */
class Field
{

    /**
     * Create an checkbox field
     *
     * @param string $id
     * @return Field
     * @throws Exception
     */
    public static function checkBox(string $id): CheckboxField
    {
        return static::make(CheckboxField::class, $id);
    }

    /**
     * Create a new FieldGenerator instance.
     *
     * @template T of \FormSchema\Schema\Field
     *
     * @param class-string<T> $fieldType
     * @param string $id
     * @return T
     * @throws Exception
     */
    public static function make(string $fieldType, string $id): FieldSchema
    {
        $valid = config('form-schema.components.valid', []);
        if (is_subclass_of($fieldType, FieldSchema::class)) {
            $field = new $fieldType;
        } elseif (count($valid) > 0 && in_array($fieldType, $valid)) {
            $field = new AnonymousField($fieldType);
        } else {
            throw new Exception(sprintf('The field type must be a class extending FieldSchema or a whitelisted anonymous component, [%s] given', $fieldType));
        }
        $field->setId($id);
        return $field;
    }

    /**
     * Create an checklist field
     *
     * @param string $id
     * @return Field
     * @throws Exception
     */
    public static function checkList(string $id): CheckListField
    {
        return static::make(CheckListField::class, $id);
    }

    /**
     * Create a file upload field
     *
     * @param string $id
     * @return Field
     * @throws Exception
     */
    public static function fileUpload(string $id): FileUploadField
    {
        return static::make(FileUploadField::class, $id);
    }

    /**
     * Create an array field, used for creating arrays of strings
     *
     * @param string $id
     * @return ArrayField
     * @throws Exception
     */
    public static function array(string $id): ArrayField
    {
        return static::make(ArrayField::class, $id);
    }

    /**
     * Create an radios field
     *
     * @param string $id
     * @return Field
     * @throws Exception
     */
    public static function radios(string $id): RadiosField
    {
        return static::make(RadiosField::class, $id);
    }

    /**
     * Create an select field
     *
     * @param string $id
     * @return Field
     * @throws Exception
     */
    public static function select(string $id): SelectField
    {
        return static::make(SelectField::class, $id);
    }

    /**
     * Create a switch field
     *
     * @param string $id
     * @return Field
     * @throws Exception
     */
    public static function switch(string $id): SwitchField
    {
        return static::make(SwitchField::class, $id);
    }

    /**
     * Create an textarea field
     *
     * @param string $id
     * @return Field
     * @throws Exception
     */
    public static function textArea(string $id): TextAreaField
    {
        return static::make(TextAreaField::class, $id);
    }

    public static function textInput(string $id): TextInputField
    {
        return static::make(TextInputField::class, $id);
    }

    public static function tags(string $id): TagField
    {
        return static::make(TagField::class, $id);
    }

    public static function number(string $id): NumberField
    {
        return static::make(NumberField::class, $id);
    }

    public static function html(string $id): HtmlField
    {
        return static::make(HtmlField::class, $id);
    }

    public static function text(string $id): TextInputField
    {
        return static::make(TextInputField::class, $id);
    }

    public static function email(string $id): EmailField
    {
        return static::make(EmailField::class, $id);
    }

}
