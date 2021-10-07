---
layout: docs
title: Introduction
nav_order: 1
---

# Form Schema Generator
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

Form Schema Generator is a Laravel-based package that allows you to generate forms directly in PHP. It makes form schema
generation simple, and with several third party integrations lets you quickly build up full forms from your controller.

## Why use a form schema?

It allows you to very quickly scaffold whole functioning pages, even using a drag and drop generator (coming soon). These
components can be made once and used for every form.

Using a form schema protects your forms against changes in the frontend, making them UI kit agnostic. Whether you use one
of our UI kits or your own, you don't need to change the form generation when changing UI kits.

## Example Use

```php
$form = Form::make('Contact Details')->withField(
    Field::telephone('telephone')->setLabel('Your phone number')->setHint('Start the number with your country code')->setRequired(true),
)->getSchema();

$form->toArray() === [
    'title' => 'Contact Details',
    'fields' => [
        [
            'id' => 'telephone',
            'type' => 'telephone',
            'label' => 'Your phone number',
            'value' => null,
            'required' => true,
            'hint' => 'Start the number with your country code'
        ]
    ]
];
```

The exact output of the form would depend on your ui kit, and changing this will be covered later.

## Installation

To install the form schema generator, run `composer require tobytwigger/form-schema-generator`.

## Learn More
- 
- [Using the form generator]({{ site.baseurl }}{% link _docs/generating.md %})
- [Adding Fields]({{ site.baseurl }}{% link _docs/fields/index.md %})
- [Available Fields]({{ site.baseurl }}{% link _docs/fields/core-fields.md %})
- [Changing the schema]({{ site.baseurl }}{% link _docs/transformers.md %})
- [Integrations]({{ site.baseurl }}{% link _docs/integrations/index.md %})
