<?php

namespace FormSchema\Transformers;

use FormSchema\Schema\Field;
use FormSchema\Schema\Form;
use FormSchema\Schema\Group;

/**
 * @package FormSchema\Transformers
 */
class PortalUiKitTransformer implements Transformer
{

    /**
     * Transform the form schema to json
     *
     * @param Form $form
     * @return string
     */
    public function transformToJson(Form $form): string
    {
        return json_encode($this->transformToArray($form));
    }

    /**
     * Transform the form schema to an array
     *
     * @param Form $form
     * @return array
     */
    public function transformToArray(Form $form): array
    {
        return [
            'title' => $form->getTitle(),
            'subtitle' => $form->getSubtitle(),
            'description' => $form->getDescription(),
            'groups' => array_map(fn (Group $group) => $this->transformGroupToArray($group), $form->groups()),
        ];
    }

    private function transformGroupToArray(Group $group): array
    {
        return array_filter([
            'title' => $group->getTitle(),
            'subtitle' => $group->getSubtitle(),
            'fields' => array_map(fn (Field $field) => $this->transformFieldToArray($field), $group->fields())
        ]);
    }

    private function transformFieldToArray(Field $field): array
    {
        return array_merge(
            [
                'id' => $field->getId(),
                'type' => $field->getType(),
                'label' => $field->getLabel(),
                'value' => $field->getValue(),
                'visible' => $field->isVisible(),
                'disabled' => $field->isDisabled(),
                'required' => $field->isRequired(),
                'hint' => $field->getHint(),
                'tooltip' => $field->getTooltip(),
                'errorKey' => $field->getErrorKey()
            ],
            $field->getAppendedAttributes(),
            $field->getOptions()
        );
    }
}
