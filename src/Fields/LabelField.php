<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class LabelField extends Field
{

    protected $type = 'label';

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return [];
    }

}