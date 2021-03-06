<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class InputField extends Field
{

    protected $type = 'input';

    /**
     * Type of input element
     *
     * @var string
     */
    protected $inputType;

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return ['inputType' => $this->inputType()];
    }

}