---
layout: docs
title: Generating Schemas
nav_order: 2
---

# Generating Schemas
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

A form is fundamentally an instance of `\FormSchema\Schema\Form`, which itself is a data object that holds all the properties of the form, and in turn the groups and fields in the form.

## Creating a Form

To create a form, you can use the handy Form generator. This will create you a new form instance, and give you a fluent interface to build up the rest of your form.

Forms can take three attributes, a title, subtitle and description. All these are optional. Exactly which you should use and what these do depends on the UI kit, for the portal the title and subtitle are shown on the page, with the description being used for screen readers.

`$form = \FormSchema\Generator\Form::make('Form Title', 'Form Subtitle', 'Form Description');`

Having created your form, you should convert it to a form schema using `$form->getSchema()`. This can be done fluently in the same line that creates the form.

### Groups

Within a form, fields are grouped into groups. These provide a simple way to set up multi-page forms, where each group of fields can be a new tab. Depending on the UI kit, this may also
present itself as a sorted form, collapsible groups to show and hide fields etc. A group has a title and a subtitle, which as with a form are both optional fields.

`$group = \FormSchema\Generator\Group::make('Group Title', 'Group Subtitle')`.

You can attach a group to a form by using `withGroup`.

```php
\FormSchema\Generator\Form::make()->withGroup(
    \FormSchema\Generator\Group::make('Title', 'Subtitle')
);
```

### Fields

Fields will be covered in depth later, including adding custom fields and using anonymous fields. To a basic level, Fields are
generated in much the same way as the form and group. `::make` can be replaced with `::textInput`, `::checkList` or any number
of other fields.

`$field = \FormSchema\Generator\Field::textInput('field-id')`

You can then chain the field attributes onto this call to build up a more compete field. The available attributes will be covered in the fields documentation.

Fields can be added to groups using `withField`:

```php
\FormSchema\Generator\Form::make()->withGroup(
    \FormSchema\Generator\Group::make()->withField(
        \FormSchema\Generator\Field::switch('my-component')
    )
);
```

## Using a Form

Once you have a form, you can convert it to html or json. Although Laravel will generally take care of this for you if you just return the form, 
it can be good to explicitly cast the form in some cases. 

`$form->toArray()` or `$form->toJson()` will return the form in array or json format.

To cast the form to your preferred format, use the `form()` helper function. This will check in your config for `form-schema.default-cast`, which is
one of either `json` or `array`. It will then cast the form to the defined format.
