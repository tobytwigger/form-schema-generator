<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class SelectField extends Field
{

    protected array $selectOptions = [];

    protected bool $multiple = false;

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return [
            'selectOptions' => $this->getSelectOptions(),
            'multiple' => $this->isMultiple()
        ];
    }

    public function withOption(string $id, string $value): SelectField
    {
        $this->selectOptions[] = [
            'id' => $id, 'value' => $value
        ];
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

}
