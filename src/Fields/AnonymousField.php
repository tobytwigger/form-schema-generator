<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class AnonymousField extends Field
{

    protected string $anonymousComponentType;

    public function __construct(string $type)
    {
        $this->anonymousComponentType = $type;
    }

    public function getAppendedAttributes(): array
    {
        return [];
    }

    public function getType(): string
    {
        return $this->anonymousComponentType;
    }
}
