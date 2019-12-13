<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class RadiosField extends Field
{

    protected $type = 'radios';

    protected $values;

    protected $radiosOptions;

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return [
            'values' => $this->values(),
            'radiosOptions' => $this->radiosOptions()
        ];
    }

}