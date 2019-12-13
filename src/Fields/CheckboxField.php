<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class CheckboxField extends Field
{

    protected $type = 'checkbox';

    /**
     * Can the checkbox be autocompleted by the browser?
     * 
     * @var bool
     */
    protected $autoComplete;
    
    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return ['autocomplete' => $this->autoComplete()];
    }

}