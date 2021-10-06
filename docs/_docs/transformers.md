---
layout: docs
title: Transformers
nav_order: 5
---

# Transformers
{: .no_toc }

<details open markdown="block">
  <summary>
    Contents
  </summary>
  {: .text-delta }
1. TOC
{:toc}
</details>

---

The form schema generator has been built to be UI kit agnostic, meaning the PHP code you write to generate fields will never have to change.

UI kits, however, often have specific requirements on the format of the schema, and therefore we need a way to transform a `\FormSchema\Schema\Form` into an array or json for a 
specific UI kit.

This is what a transformer does. It is a class with a `toArray` method, that takes a form instance and should return an array that represents the schema.

## Creating a Transformer

Your transformer should be a class that implements `\FormSchema\Transformers\Transformer`.

```php
class CustomTransformer implements \FormSchema\Transformers\Transformer
{

    public function transformToArray(Form $form): array
    {
        // Here we can use the form getters to transform into any schema
        
        // We will map through the groups, then in turn the fields, to get the groups and fields into the schema.
       
         return [
            'title' => $form->getTitle(),
            'subtitle' => $form->getSubtitle(),
            'description' => $form->getDescription(),
            'groups' => array_map(function (Group $group) { 
                return [
                    'title' => $group->getTitle(),
                    'subtitle' => $group->getSubtitle(),
                    'fields' => array_map(function (Field $field) { 
                        return [
                            'id' => $field->getId(),
                            'type' => $field->getType(),
                            'label' => $field->getLabel(),
                            ...
                        ];
                    }, $group->fields())
                ];
            }, $form->groups()),
        ];
    }

    public function transformToJson(Form $form): string
    {
        return json_encode($this->transformToJson($form));
    }
}
```

## Registering a Transformer

Once you've created a transformer for your UI kit, you will need to register it in a service provider. In the boot method, put

```php
    app(\FormSchema\Transformers\TransformerManager::class)->extend(
        'my-custom-transformer',
        fn(\Illuminate\Contracts\Container\Container $container) => $container->make(\My\Custom\Transformer::class)
    );
```

This will make your transformer available with a name `my-custom-transformer`

## Switching the Transformer

To select your new transformer, in the config `form-schema`, change `transformer` to be `my-custom-transformer`. Whenever
you use `$form->toArray()`, or `form($form)`, your new transformer will be used and the new schema returned.
