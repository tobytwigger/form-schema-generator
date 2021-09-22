<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class NumberField extends Field
{

    public function getType(): string
    {
        return 'number';
    }

    public function getAppendedAttributes(): array
    {
        return [];
    }
}
