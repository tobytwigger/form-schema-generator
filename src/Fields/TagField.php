<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class TagField extends Field
{

    public function getType(): string
    {
        return 'tags';
    }

    public function getAppendedAttributes(): array
    {
        return [];
    }
}
