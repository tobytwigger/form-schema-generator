<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class SelectField extends Field
{

    protected array $selectOptions = [];

    protected bool $multiple = false;

    protected string $nullLabel = '';

    protected ?string $nullValue = null;

    protected bool $showNullOption = false;

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return [
            'selectOptions' => $this->getSelectOptions(),
            'multiple' => $this->isMultiple(),
            'nullLabel' => $this->nullLabel,
            'nullValue' => $this->nullValue,
            'showNullOption' => $this->showNullOption
        ];
    }

    public function withOption(string $id, string $value, ?string $group = null): SelectField
    {
        $option = ['id' => $id, 'value' => $value];
        if($group !== null) {
            $option['group'] = $group;
        }

        $this->selectOptions[] = $option;

        return $this;
    }

    /**
     * @return array
     */
    public function getSelectOptions(): array
    {
        return $this->selectOptions;
    }

    public function setSelectOptions(array $selectOptions): SelectField
    {
        $this->selectOptions = $selectOptions;
        return $this;
    }

    public function getType(): string
    {
        return 'select';
    }

    /**
     * @return bool
     */
    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    /**
     * @param bool $multiple
     * @return SelectField
     */
    public function setMultiple(bool $multiple): SelectField
    {
        $this->multiple = $multiple;
        return $this;
    }

    public function withNullOption(string $text = '', ?string $value = null): SelectField
    {
        $this->showNullOption = true;
        $this->nullValue = $value;
        $this->nullLabel = $text;
        return $this;
    }

}
