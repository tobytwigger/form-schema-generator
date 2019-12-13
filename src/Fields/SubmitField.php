<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class SubmitField extends Field
{

    protected $type = 'submit';

    protected $buttonText;

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return ['buttonText' => $this->buttonText()];
    }

}