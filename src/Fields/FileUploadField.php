<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class FileUploadField extends Field
{

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return [];
    }

    public function getType(): string
    {
        return 'file';
    }
}
