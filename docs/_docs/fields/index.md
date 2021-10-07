---
layout: docs
title: Fields
nav_order: 3
has_children: true
---


# Extending
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

## Using Fields

This page will take you through using fields and anonymous fields to quickly scaffold forms. 

### Defining

A field must have a unique ID to identify the field, which will normally be the key you expect the form to submit the input as. All fields can also contain all the core attributes defined below. Some fields will also have extra attributes that they need.

#### Core Attributes

##### ID (string)

This is the ID of the field. It must be unique on the page, and is used for passing data back to the server from the form, defining
labels and any js, and anything else that needs to reference the field uniquely. It is the only required field to make a form.

##### Label (string|null)

The label is the text associated with the field, and should be a short summary of what the field is. For example, 'Are you a robot?', 'Email Address' etc.

##### Value (mixed)

This is the value of the field, and will be shown when the form is rendered.

##### Visible (bool)

This defines if the field is visible or not.

##### Disabled (bool)

This defines if the field should be disabled

##### Required (bool)

This defines if the field is required or not

##### Hint (string|null)

This is shown below the field, and should add information to help the user fill in the form

##### Tooltip (string|null)

If given, this should be shown next to the field, but only on hover. It's a great place to put a much lengthier description, such
as in a `Learn More` link.

##### Error Key (string|null)

The key of the errors that the field should show. This is useful when you manipulate the fields before sending them to the server,
so you end up with the field ID and the associated error ID being different. If left blank, the errors shown will be those
with an ID matchng the field ID.

##### Options

In addition to the predefined core attributes, and any custom attributes a field may define, you can dynamically add options
on the fly. Exactly how these are used depends on your UI Kit, but it can be very useful to add miscellaneous configuration that
may be needed by a UI kit without having to edit the field directly or create a new field.

To add an option, call `$field->withOption('option-key', 'option-value)`. You can then check if options are defined, and
get all options, with `$field->hasOptions();` and `$field->getOptions();`

#### Class-based fields

Class-based fields are defined as a class that extends `\FormSchema\Schema\Field`. These have all the core attributes by default, and may contain additional attributes.

If the field is a core field, you can use the `\FormSchema\Generator\Field::fieldType('field-id)` function, where `fieldType` is the type of field you want (e.g. `radio`). If the field is 
a custom class-based field, just pass in the class name such as `\FormSchema\Generator\Field::make(\My\Field::class, 'field-id')`. You can also create yourself a new generator to access your own
fields through a static factory as with core fields - see the Adding a Field section for more.

#### Anonymous Fields

It's not always convenient to create a new class per field. Often, your UI kit may support many types of fields and you'd rather just reference the type directly. In these cases, you can
simply use `\FormSchema\Generator\Field::make('fieldType', 'field-id')` to create an anonymous field of type `fieldType`. This field will have access to all the core attributes, and 
you can use options to add further configuration to the fields.

##### Validity of field

With anonymous fields, you open the risk of typos leading to fields not rendering. To control which anonymous fields can be used, you can define an array of field types in your `form-schema` config, 
with the key `components.valid`. If this array is empty, all anonymous fields are allowed. If you populate it, the generator will validate any new field types against the configuration

### Adding a field

No work is needed to add a new anonymous field (other than optionally whitelisting the field type). Class-based fields tend to be more robust and useful though, as you can 
predefine additional attributes and benefit from IDE typehinting. To create a new field, just define a class in a `Fields` folder. For this example, we will create a class that 
provides a captcha.

```php
class CaptchaField extends \FormSchema\Schema\Field
{

    protected int $allowedAttempts = 10;

    public function getAppendedAttributes(): array
    {
        return [
            'attempts' => $this->allowedAttempts
        ];
    }
    
    public function setAllowedAttempts(int $attempts): CaptchaField
    {
        $this->allowedAttempts = $attempts;
        return $this;
    }

    public function getType(): string
    {
        return 'captcha';
    }
    
}
```

There are two methods you must always implement, `getType` and `getAppendedAttributes`.
- The `getType` function must return a string that represents the type of the field. This will be used in the schema to define the field type.
- The `getAppendedAttributes` function allows you to add custom attributes to your field.

#### Custom Attributes

Using `getAppendedAttributes` allows us to use typehinting for custom attributes specific to a single field. In the above case, we want to define
an allowed attempts attribute onto the captcha field. We define `getAppendedAttributes`, which when called should return all the custom attributes
(in our case the allowed attempts), and a value for them. We use a protected property to store the number of allowed attempts.

We have also defined a 'fluent setter' to make it easy to set the number of allowed attempts. These functions start in `set`, and
then the property name, such as `setAllowedAttempts`. Passing it the number of attempts saves it to the protected property, so that
when `getAppendedAttributes` is called the newly set value is returned.

You don't need to use additional attributes if you don't want to, but the option is there if your field does have custom attributes.

#### Using your field

Having created a field, you can then use it in the generator when building up a form.

The easiest way to do this is to pass the field name into `Field::make`. For example,

```php
\FormSchema\Generator\Field::make(\My\Captcha\Field::class, 'field-id');
```

You can also create a custom generator. Create a class called `Field`, extending the `\FormSchema\Generator\Field` function. For adding the captcha
field to this new generator, we would add the following function to it.

```php
    public static function captcha(string $id): CheckListField
    {
        return static::make(\My\Captcha\Field::class, $id);
    }
```

Now to generate the field, we use the new field generator

`\My\Custom\FieldGenerator::captcha('field-id')`
