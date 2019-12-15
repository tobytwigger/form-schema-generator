<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class SwitchField extends Field
{

    protected $type = 'switch';

    protected $textOn;
    protected $textOff;
    protected $valueOn;
    protected $valueOff;

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return [
            'textOn' => $this->textOn(),
            'textOff' => $this->textOff(),
            'valueOn' => $this->valueOn(),
            'valueOff' => $this->valueOff
        ];
    }

}