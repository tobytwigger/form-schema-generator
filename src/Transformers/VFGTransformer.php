<?php

namespace FormSchema\Transformers;

use FormSchema\Schema\Field;
use FormSchema\Schema\Form;
use FormSchema\Schema\Group;

class VFGTransformer implements Transformer
{

    public function transformToJson(Form $form): string
    {
        return json_encode($this->transformToArray($form));
    }

    public function transformToArray(Form $form): array
    {
        return [
            'schema' => $form->toArray(),
            'model' => $this->extractModel($form),
            'options' => $this->extractOptions($form)
        ];
    }

    public function extractModel($formOrGroup)
    {
        $model = [];
        foreach ($formOrGroup->fields() as $field) {
            $model[$field->model()] = null;
        }
        if($formOrGroup instanceof Form) {
            foreach($formOrGroup->groups() as $group) {
                $model = array_merge($model, $this->extractModel($group));
            }
        }
        return $model;
    }

    public function extractOptions(Form $form)
    {
        return [];
    }

    private function extractModelFromGroup(Group $group)
    {

    }
}