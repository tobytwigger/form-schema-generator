# Form Schema Generator

A small library for working with form schemas. Designed predominantly around the [portal-ui-kit](https://github.com/bristol-su/portal-ui-kit) package, easily create schemas using a fluent PHP Api.

## Installation

You can install the schema generator through composer

```bash
composer install tobytwigger/form-schema-generator
```

## Usage

You can create a schema in one of two ways

### With Schema objects
In the ```\FormSchema\Schema``` namespace, we provide a Form, Group and Field class. You may create a form schema from scratch using these

```php
use \FormSchema\Schema\Form;
use \FormSchema\Schema\Group;
use \FormSchema\Fields\InputField;

# Create a form
$form = new Form;

# Create a group
$group = new Group;
$group->setLegend('User Details');

# Create a field
$field = new TextInputField;
$field->setId('username');
$field->setLabel('Your Username');

# Tie the schemas together
$group->addField($field);
$form->addGroup($group);

echo $form;
/*
* [
*    'groups' => [
*        'legend' => 'User Details',
*        'fields' => [
*            [
*                'type' => 'input',
*                'inputType' => 'text',
*                'label' => 'Your Username',
*                'model' => 'username'
*            ]
*        ]
*    ]
* ]
*/
```

All core fields are offered as field types, the full list can be found in the ```FormSchema\Fields``` namespace. Custom fields can also be added.

To get the exact schema for the vue-form-generator package, use the ```\FormSchema\Transformers\Transformer``` class. Calling the transformToArray or transformToJson methods, passing in a form schema, will return an array set up for the renderer.

### Using the fluent API

We also provide a set of classes in the ```FormSchema\Generators``` namespace. These are wrappers around the schema objects to provide method chaining and helper functions. To recreate the above schema using the API:

```php
use \FormSchema\Generators\Form;
use \FormSchema\Generators\Group;
use \FormSchema\Generators\Field;

echo Form::make('Title', 'Subtitle', 'Description')->withGroup(
    Group::make('Title', 'Subtitle')->->withField(
        Field::textInput('username')->label('Your Username')
    )
);

/*
* [
*    'groups' => [
*        'legend' => 'User Details',
*        'fields' => [
*            [
*                'type' => 'input',
*                'inputType' => 'text',
*                'label' => 'Your Username',
*                'model' => 'username'
*            ]
*        ]
*    ]
* ]
*/
```

The form and group generators must always be created using the static make function. The ```Form::make()``` function accepts no arguments, but the ```Group::make()``` function accepts an optional legend (i.e. ```Group::make('User Details')```). 

To use the Field generator, either call the make() method and pass it the name of the class representing the field, and the model key, or use one of the static methods referencing a specific field and pass just the model key.

i.e. ```Field::make(SelectField::class, 'my-select') === Field::select('my-select');```

### Field Guide

This section gives a quick summary of each fields possible options. When using the package, you can copy the examples below into your code and delete/modify any fields.

As more fields are added to the package, their example will be put below.

The API for this is the old API, please see the code and above for the updated API.

#### Checkbox

A simple checkbox field

```php
\FormSchema\Generator\Field::checkBox('field_id')->label('Field Label')->featured(true)->required(true)->default(true)->hint('A hint for the field')->help('A more in depth description, shown on a hover over')
```

#### Checklist

Multiple checkboxes. Optionally allow for a listbox instead of a set of checkboxes.

```php
\FormSchema\Generator\Field::checkList('field_id')->label('Field Label')->featured(true)->required(true)->default(true)->hint('A hint for the field')->help('A more in depth description, shown on a hover over')->listBox(true)->values([['value' => 1, 'name' => 'Name 1], ...])
```


#### Input

A standard HTML Input field. This field should not be used for buttons, files, images, radios, reset, search or submit types.

```php
\FormSchema\Generator\Field::input('field_id')->inputType('text')->label('Field Label')->featured(true)->required(true)->default(true)->hint('A hint for the field')->help('A more in depth description, shown on a hover over')
```

#### Label

A simple field for non-editable values, such as a created time, timestamp etc.

```php
\FormSchema\Generator\Field::labels('field_id')->label('Field Label')->featured(true)->required(true)->default(true)->hint('A hint for the field')->help('A more in depth description, shown on a hover over')
```

#### Radios

Radio buttons for single selections

```php
\FormSchema\Generator\Field::radios('field_id')->label('Field Label')->featured(true)->required(true)->default(true)->hint('A hint for the field')->help('A more in depth description, shown on a hover over')->values([['value' => 1, 'name' => 'Option 1', 'disabled' => false], ...])
```

#### Select

A single select dropdown

```php
\FormSchema\Generator\Field::select('field_id')->label('Field Label')->featured(true)->required(true)->default(true)->hint('A hint for the field')->help('A more in depth description, shown on a hover over')->values([['id' => 1, 'name' => 'Option 1'], ...])->selectOptions(['noneSelectedText' => 'Please Select an Option', 'hideNoneSelectedText' => false])
```

#### Submit

A simple submit button

```php
\FormSchema\Generator\Field::submit('field_id')->label('Field Label')->featured(true)->required(true)->default(true)->hint('A hint for the field')->help('A more in depth description, shown on a hover over')->buttonText('Submit the Form')
```

#### Text Area

A text area for large text entries

```php
\FormSchema\Generator\Field::textArea('field_id')->label('Field Label')->featured(true)->required(true)->default(true)->hint('A hint for the field')->help('A more in depth description, shown on a hover over')->placeholder('A Placeholder')->readonly(false)->rows(3)
```

#### Switch

A checkbox in the style of a switch.

```php
\FormSchema\Generator\Field::switch('field_id')->label('Field Label')->featured(true)->required(true)->default(true)->hint('A hint for the field')->help('A more in depth description, shown on a hover over')->textOn('On')->textOff('Off')->valueOn(true)->valueOff(false)
```

## Status of the project
- [x] Set up the schema and the generators
- [x] Create the VFG Transformer
- [x] Add core fields
- [ ] Add optional fields
- [ ] Add validation
- [ ] Add conditional disabled status
- [ ] Add conditional visible status
- [ ] Add conditional featured status
- [ ] Integrate optional default values when creating a new model

## Contributing
Pull requests are very welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)


## Compile Docs

-`gem install bundle`
- `bundle install`
- `bundle exec jekyll serve` to run locally
- `bundle exec jekyll build` to build
