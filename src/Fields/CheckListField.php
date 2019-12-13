<?php

namespace FormSchema\Fields;

use FormSchema\Schema\Field;

class CheckListField extends Field
{

    protected $type = 'checklist';

    protected $listBox;

    protected $values;

    protected $checklistOptions;

    /**
     * Get any field specific attributes
     *
     * @return array
     */
    public function getAppendedAttributes(): array
    {
        return [
            'listBox' => $this->listBox(),
            'values' => $this->values(),
            'checklistOptions' => $this->checklistOptions()
        ];
    }

}