<?php

namespace FormSchema\Transformers;

use FormSchema\Schema\Form;

/**
 * Transformer for the Vue Form Generator package
 * @package FormSchema\Transformers
 */
class VFGTransformer implements Transformer
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
            'schema' => $form->toArray(),
            'model' => $this->extractModel($form),
            'options' => $this->extractOptions($form)
        ];
    }

    /**
     * Pluck the model attributes out of the form
     * 
     * @param $formOrGroup
     * @return array
     */
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

    /**
     * Extract the vfg options from the form schema
     * 
     * @param Form $form
     * @return array
     */
    public function extractOptions(Form $form)
    {
        return [
	    'validateDebounceTime' => 0	
	];
    }
}
