---
layout: docs
title: Core Fields
nav_order: 4
parent: Fields
---


# Core Fields
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

## Text Input

A basic text input field.

`\FormSchema\Generator\Field::textInput(...)`

## Text Area

A text area field

`\FormSchema\Generator\Field::textArea(...)`

## Checkbox

A single checkbox, that can be on or off

`\FormSchema\Generator\Field::checkBox(...)`

## Checklist

A group of checkboxes that may be toggled independently. The result is an array of the selected checkboxes.

`\FormSchema\Generator\Field::checkList(...)`

The checklist has the following functions to set custom attributes

- `withOption(id, text)` - add a new checkbox, with an id of `id`, and show the user the `text`. If one of the selected options, the final array will have an element `id`.
- `setOptions([['id' => 'option_id', 'text' => 'Option Text], ...])` - overwrite all the options to those passed in. You must pass each of the options in a format `['id' => 'the id', 'text', => 'the text']`.

## Number

A text input with a type of number

`\FormSchema\Generator\Field::number(...)`

## Radios

A group of checkboxes, of which only one can be selected. The result is the selected radio.

`\FormSchema\Generator\Field::radios(...)`

The radio has the following functions to set custom attributes

- `withOption(id, text)` - add a new radio, with an id of `id`, and show the user the `text`. If the selected option, the final value will be `id`.
- `setOptions([['id' => 'option_id', 'text' => 'Option Text], ...])` - overwrite all the options to those passed in. You must pass each of the options in a format `['id' => 'the id', 'text', => 'the text']`.

## Select

A select input, allowing for any one of a number of options to be chosen.

`\FormSchema\Generator\Field::select(...)`

The select has the following functions to set custom attributes

- `withOption(id, value, group)` - add a new option, with an id of `id`, and show the user the `value`. If a group is given, the select will group this option under the header `group`.
- `setSelectOptions([['id' => 'option_id', 'value' => 'Option Text', 'group' => 'The group'], ...])` - overwrite all the options to those passed in. You must pass each of the options in a format `['id' => 'the id', 'text', => 'the text', 'group' => 'group']`, where `group` is optional.
- `setMultiple(bool)` - Whether or not the select should support multiple selection.
- `withNullOption(text, value)` - Show a null option on the select, with a value of `value` (defaults to null if not given) and the text `text`.

## Switch

A switch, which has the same effect as a checkbox.

`\FormSchema\Generator\Field::switch(...)`

The switch has the following functions to set custom attributes

- `setOnText('text')` - Set the text that is shown when the switch is on to `text`.
- `setOffText('text')` - Set the text that is shown when the switch is off to `text`.

## Tag

A field that allows users to enter multiple strings, or 'tags'. These are then outputted as an array of the tags.

`\FormSchema\Generator\Field::tag(...)`

## HTML

An integration with TinyMCE to show a WYSIWYG editor.

`\FormSchema\Generator\Field::switch(...)`

The html field has the following functions to set custom attributes

- `setApiKey('api-key')` - Set the TinyMCE api key to `'api-key'`.

## File Upload

A field that allows a file upload.

`\FormSchema\Generator\Field::fileUpload(...)`

## Email

A text field with a type of email.

`\FormSchema\Generator\Field::email(...)`

## Array

A field that works the same as tags, but shows the options as their own text fields.

`\FormSchema\Generator\Field::array(...)`

The array field has the following functions to set custom attributes

- `showRemoveButton(true)` - Whether to show a remove button, to allow removing of options.
