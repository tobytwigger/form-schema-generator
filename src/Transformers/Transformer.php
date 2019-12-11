<?php


namespace FormSchema\Transformers;


use FormSchema\Schema\Form;

interface Transformer
{

    public function transformToArray(Form $form): array;

    public function transformToJson(Form $form): string;
    
}