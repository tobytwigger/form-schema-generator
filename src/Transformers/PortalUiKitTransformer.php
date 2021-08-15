<?php

namespace FormSchema\Transformers;

use FormSchema\Schema\Form;

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
            'form' => $form->toArray(),
            'groupFormat' => 'single'
        ];
    }
}
