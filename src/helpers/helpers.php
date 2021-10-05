<?php

if (!function_exists('form')) {
    /**
     * Cast a form to a primitive format
     *
     * @param \FormSchema\Schema\Form $form The form to cast
     * @param string|null $format The format to cast the form to, json or array
     * @return array|false|string
     */
    function form(\FormSchema\Schema\Form $form, ?string $format = null)
    {
        $castTo = $format ?? config('form-schema.default-cast', 'json');
        if($castTo === 'array') {
            return $form->toArray();
        }
        return $form->toJson();
    }
}
