<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class SelectField extends Field
{

    protected $type = 'select';

    protected $values;

    protected $selectOptions;

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return [
            'listBox' => $this->listBox(),
            'values' => $this->values(),
            'selectOptions' => $this->selectOptions()
        ];
    }

}