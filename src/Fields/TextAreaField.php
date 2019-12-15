<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class TextAreaField extends Field
{

    protected $type = 'textArea';

    protected $autocomplete;
    protected $max;
    protected $min;
    protected $placeholder;
    protected $readonly;
    protected $rows;

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return [
            'autocomplete' => $this->autocomplete(),
            'max' => $this->max(),
            'min' => $this->min(),
            'placeholder' => $this->placeholder(),
            'readonly' => $this->readonly(),
            'rows' => $this->rows()
        ];
    }

}
