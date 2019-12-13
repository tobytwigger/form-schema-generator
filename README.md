# Form Schema Generator

A small library for working with form schemas. Designed predominantly around the [vue-form-generator](https://github.com/vue-generators/vue-form-generator) package, easily create schemas using a fluent PHP Api.

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
$field = new InputField;
$field->model('username');
$field->inputType('text');
$field->label('Your Username');

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

To get the exact schema for the vue-form-generator package, use the ```\FormSchema\Transformers\VFGTransformer``` class. Calling the transformToArray or transformToJson methods, passing in a form schema, will return an array with the ```'schema', 'options' and 'model'``` keys.

### Using the fluent API

We also provide a set of classes in the ```FormSchema\Generators``` namespace. These are wrappers around the schema objects to provide method chaining and helper functions. To recreate the above schema using the API:

```php
use \FormSchema\Generators\Form;
use \FormSchema\Generators\Group;
use \FormSchema\Generators\Field;

echo Form::make()->withGroup(
    Group::make()->legend('User Details')->withField(
        Field::input('username')->label('Your Username')->inputType('text')
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

## Status of the project
- [x] Set up the schema and the generators
- [x] Create the VFG Transformer
- [x] Add core fields
- [] Add optional fields

## Contributing
Pull requests are very welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
