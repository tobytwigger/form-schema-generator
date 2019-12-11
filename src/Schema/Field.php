<?php

namespace FormSchema\Schema;

abstract class Field
{

    /**
     * Field type
     * 
     * @var string
     */
    protected $type;
    
    /**
     * Any additional fields to be set on the schema
     *
     * @var array
     */
    protected $additional = [];

    /**
     * Label of the field
     *
     * @var string
     */
    protected $label;

    /**
     * Key of the field
     *
     * @var string
     */
    protected $model;

    /**
     * ID of the field. Auto generated if not given
     *
     * @var string
     */
    protected $id;

    /**
     * HTML field name, for use in form submissions
     *
     * @var string
     */
    protected $inputName;

    /**
     * is it a featured (bold) field? Can be a function too.
     * @var
     */
    protected $featured;

    /**
     * if false, field will be hidden. Can be a function too.
     *
     * @var
     */
    protected $visible;

    /**
     * if true, field will be disabled. Can be a function too.
     *
     * @var
     */
    protected $disabled;

    /**
     * If true, Stylizes the field as required.  Works in conjunction with validators.
     *
     * @var
     */
    protected $required;

    /**
     * if true, it will be visible only  if multiple is true in component attributes
     *
     * @var
     */
    protected $multi;

    /**
     * Default value of the field (used when creating a new model)
     *
     * @var
     */
    protected $default;

    /**
     * Show this hint below the field
     *
     * @var
     */
    protected $hint;

    /**
     * Tooltip/Popover triggered by hovering over the question icon before the caption of field. You can use HTML elements too.
     *
     * @var
     */
    protected $help;

    /**
     * Validator for value. It can be an array of functions too.
     *
     * @var
     */
    protected $validator;

    /**
     * Amount of time in milliseconds validation waits before checking, refer to validation
     *
     * @var int
     */
    protected $validateDebounceTime;


    /**
     * Custom CSS style classes. They will be appended to the .from-group
     *
     * @var
     */
    protected $styleClasses;

    /**
     * Array of button objects. This is useful if you need some helper function to fill the field. (E.g. generate password, get GPS location..etc)*
     *
     * @var
     */
    protected $buttons;

    /**
     * Custom attributes
     *
     * The attributes object is broken up into "wrapper", "input" and "label" objects which will attach attributes to the respective HTML element in the component. All VFG Core fields support these, where applicable.
     * @var
     */
    protected $attributes;

    public function toArray()
    {
        return array_merge(array_filter([
            'type' => $this->type(),
            'label' => $this->label(),
            'model' => $this->model(),
            'id' => $this->id(),
            'inputName' => $this->inputName(),
            'featured' => $this->featured(),
            'visible' => $this->visible(),
            'disabled' => $this->disabled(),
            'required' => $this->required(),
            'multi' => $this->multi(),
            'default' => $this->default(),
            'hint' => $this->hint(),
            'help' => $this->help(),
            'styleClasses' => $this->styleClasses(),
            'buttons' => $this->buttons(),
            'attributes' => $this->attributes(),
        ], function ($val) {
            return !is_null($val);
        }), $this->additional, array_filter($this->getAppendedAttributes(), function ($val) {
            return !is_null($val);
        }));
    }

    abstract public function getAppendedAttributes(): array;

    public function setCustomField(string $fieldName, $fieldValue)
    {
        $this->additional[$fieldName] = $fieldValue;
    }

    public function __call($name, $arguments)
    {
        if(count($arguments) === 0) {
            if (method_exists($this, ($method = 'get' . ucfirst($name)))) {
                return $this->{$method}();
            } elseif (property_exists($this, $name)) {
                return $this->{$name};
            }
        } elseif(count($arguments) === 1) {
            if (method_exists($this, ($method = 'set' . ucfirst($name)))) {
                $this->{$method}(...$arguments);
            } elseif (property_exists($this, $name)) {
                $this->{$name} = $arguments[0];
            }
        }
    }

}