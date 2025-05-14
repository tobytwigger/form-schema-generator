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
     * Label of the field
     *
     * @var string
     */
    protected ?string $label = null;

    /**
     * The value of the field
     *
     * @var mixed
     */
    protected $value = null;

    /**
     * if false, field will be hidden.
     *
     * @var bool
     */
    protected bool $visible = true;

    /**
     * If true, field will be disabled.
     *
     * @var bool
     */
    protected bool $disabled = false;

    /**
     * If true, the field is required
     *
     * @var bool
     */
    protected bool $required = false;

    /**
     * Show this hint below the field
     *
     * @var string
     */
    protected ?string $hint = null;

    /**
     * Tooltip/Popover triggered by hovering over the question icon before the caption of field. You can use HTML elements too.
     *
     * @var string
     */
    protected ?string $tooltip = null;

    /**
     * The key of the error to pick up
     *
     * @var string|null
     */
    protected ?string $errorKey = null;

    protected array $options = [];

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return static
     */
    public function setId(string $id): static
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    abstract public function getType(): string;

    /**
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return static
     */
    public function setLabel(string $label): static
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
     * @return static
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
     * @return static
     */
    public function setVisible(bool $visible): static
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
     * @return static
     */
    public function setDisabled(bool $disabled): static
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
     * @return static
     */
    public function setRequired(bool $required): static
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHint(): ?string
    {
        return $this->hint;
    }

    /**
     * @param string $hint
     * @return static
     */
    public function setHint(string $hint): static
    {
        $this->hint = $hint;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTooltip(): ?string
    {
        return $this->tooltip;
    }

    /**
     * @param string $tooltip
     * @return static
     */
    public function setTooltip(string $tooltip): static
    {
        $this->tooltip = $tooltip;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getErrorKey(): ?string
    {
        return $this->errorKey;
    }

    /**
     * @param string|null $errorKey
     * @return Field
     */
    public function setErrorKey(?string $errorKey): static
    {
        $this->errorKey = $errorKey;
        return $this;
    }

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    abstract public function getAppendedAttributes(): array;

    public function withOptions(array $options): static
    {
        $this->options = array_merge(
            isset($this->options) ? $this->options : [],
            $options
        );
        return $this;
    }

    public function hasOptions(): bool
    {
        return count($this->options) > 0;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

}
