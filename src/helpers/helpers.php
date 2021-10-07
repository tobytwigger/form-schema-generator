<?php

use FormSchema\Generator\Form as FormGenerator;
use FormSchema\Schema\Form as FormSchema;

if (!function_exists('form')) {
    /**
     * Cast a form to a primitive format
     *
     * @param FormSchema|FormGenerator $form The form to cast
     * @param string|null $format The format to cast the form to, json or array
     * @return array|false|string
     */
    function form(FormSchema|FormGenerator $form, ?string $format = null)
    {
        if($form instanceof FormGenerator) {
            $form = $form->getSchema();
        }
        $castTo = $format ?? config('form-schema.default-cast', 'json');
        if($castTo === 'array') {
            return $form->toArray();
        }
        return $form->toJson();
    }
}
