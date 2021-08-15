<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class CheckListField extends Field
{

    protected array $checklists = [];

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return [
            'checklists' => $this->getChecklists()
        ];
    }

    public function withOption(string $id, string $text): CheckListField
    {
        $this->checklists[] = [
            'id' => $id, 'text' => $text
        ];
        return $this;
    }

    /**
     * @return array
     */
    public function getChecklists(): array
    {
        return $this->checklists;
    }

    public function getType(): string
    {
        return 'checklist';
    }
}
