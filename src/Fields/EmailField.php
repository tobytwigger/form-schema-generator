<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class EmailField extends Field
{

    public function getType(): string
    {
        return 'text';
    }

    public function getAppendedAttributes(): array
    {
        return [];
    }
}
