<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class TextInputField extends Field
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
