<?php

namespace FormSchema\Schema;

abstract class Field
{

    /**
     * ID of the field. Auto generated if not given
     *
     * @var string
     */
    protected string $id;

    /**
     * Type of field. This should be set in the implementation of the field.
     *
     * @var string
     */
    protected string $type;

    /**
     * Label of the field
     *
     * @var string
     */
    protected string $label;

    /**
     * The value of the field
     *
     * @var mixed
     */
    protected $value;

    /**
     * if false, field will be hidden.
     *
     * @var bool
     */
    protected bool $visible;

    /**
     * If true, field will be disabled.
     *
     * @var bool
     */
    protected bool $disabled;

    /**
     * If true, the field is required
     *
     * @var bool
     */
    protected bool $required;

    /**
     * Show this hint below the field
     *
     * @var string
     */
    protected string $hint;

    /**
     * Tooltip/Popover triggered by hovering over the question icon before the caption of field. You can use HTML elements too.
     *
     * @var string
     */
    protected string $tooltip;

    /**
     * Any additional fields to be set on the schema
     *
     * @var array
     */
    protected array $additional = [];

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Field
     */
    public function setId(string $id): Field
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Field
     */
    public function setType(string $type): Field
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return Field
     */
    public function setLabel(string $label): Field
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return Field
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->visible;
    }

    /**
     * @param bool $visible
     * @return Field
     */
    public function setVisible(bool $visible): Field
    {
        $this->visible = $visible;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     * @return Field
     */
    public function setDisabled(bool $disabled): Field
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     * @return Field
     */
    public function setRequired(bool $required): Field
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @return string
     */
    public function getHint(): string
    {
        return $this->hint;
    }

    /**
     * @param string $hint
     * @return Field
     */
    public function setHint(string $hint): Field
    {
        $this->hint = $hint;
        return $this;
    }

    /**
     * @return string
     */
    public function getTooltip(): string
    {
        return $this->tooltip;
    }

    /**
     * @param string $tooltip
     * @return Field
     */
    public function setTooltip(string $tooltip): Field
    {
        $this->tooltip = $tooltip;
        return $this;
    }

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    abstract public function getAppendedAttributes(): array;

    /**
     * Return the field schema as an array.
     *
     * This function must take into account all core attributes, as well as additional attributes and field specific attributes
     *
     * @return array
     */
    public function toArray()
    {
        return array_merge(
            array_filter([
                'id' => $this->getId(),
                'type' => $this->getType(),
                'label' => $this->getLabel(),
                'value' => $this->getValue(),
                'visible' => $this->isVisible(),
                'disabled' => $this->isDisabled(),
                'required' => $this->isRequired(),
                'hint' => $this->getHint(),
                'tooltip' => $this->getTooltip()
            ]),
            array_filter($this->getAppendedAttributes())
        );
    }

}
