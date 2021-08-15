<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class SelectField extends Field
{

    protected array $selectOptions = [];

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return [
            'selectOptions' => $this->getSelectOptions()
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

    public function getType(): string
    {
        return 'select';
    }
}
