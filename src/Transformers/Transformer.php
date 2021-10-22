<?php

namespace FormSchema\Transformers;

use FormSchema\Schema\Field;
use FormSchema\Schema\Form;

/**
 * Interface Transformer
 *
 * Used to transform a Form Schema object into a json or array representation
 *
 * @package FormSchema\Transformers
 */
interface Transformer
{

    /**
     * Transform the form schema to an array representation
     *
     * @param Form $form
     * @return array
     */
    public function transformToArray(Form $form): array;

    /**
     * Transform the form schema to a json representation
     *
     * @param Form $form
     * @return string
     */
    public function transformToJson(Form $form): string;

    /**
     * Transform a field schema to a json representation
     *
     * @param Field $field
     * @return string
     */
    public function transformFieldToJson(Field $field): string;

    /**
     * Transform a field schema to an array representation
     *
     * @param Field $field
     * @return array
     */
    public function transformFieldToArray(Field $field): array;

}
