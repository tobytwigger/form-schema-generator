<?php

namespace FormSchema\Tests\Unit\Generator;

use FormSchema\Tests\TestCase;
use ReflectionClass;
use FormSchema\Fields\InputField;
use FormSchema\Generator\Field as FieldGenerator;
use FormSchema\Schema\Field;
use FormSchema\Schema\Field as FieldSchema;

class FieldTest extends TestCase
{

    /**
     * @test
     * @covers \FormSchema\Generator\Field::make
     */
    public function make_returns_a_field_generator_instance()
    {
        $field = FieldGenerator::make(DummyField::class, 'model1');
        $this->assertInstanceOf(FieldGenerator::class, $field);
    }

    /**
     * @test
     * @covers \FormSchema\Generator\Field::make
     * @covers \FormSchema\Generator\Field::__construct
     */
    public function make_passes_a_dummy_field_schema_instance_to_the_field_generator()
    {
        $field = FieldGenerator::make(DummyField::class, 'model1');
        $fieldReflection = new ReflectionClass(FieldGenerator::class);
        $fieldReflectionProperty = $fieldReflection->getProperty('field');
        $fieldReflectionProperty->setAccessible(true);
        $this->assertInstanceOf(FieldSchema::class, $fieldReflectionProperty->getValue($field));
        $this->assertInstanceOf(DummyField::class, $fieldReflectionProperty->getValue($field));
    }

    /**
     * @test
     * @covers \FormSchema\Generator\Field::make
     */
    public function make_sets_the_model_on_the_field()
    {
        $field = FieldGenerator::make(DummyField::class, 'model1');
        $fieldReflection = new ReflectionClass(FieldGenerator::class);
        $fieldReflectionProperty = $fieldReflection->getProperty('field');
        $fieldReflectionProperty->setAccessible(true);
        $fieldSchema = $fieldReflectionProperty->getValue($field);
        $this->assertEquals('model1', $fieldSchema->getAttribute('model'));
    }

    /**
     * @test
     * @covers \FormSchema\Generator\Field::make
     */
    public function make_throws_an_exception_if_the_given_class_does_not_extend_field_schema()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The field type must be a class extending FieldSchema, FormSchema\Tests\Unit\Generator\NotAField given');

        FieldGenerator::make(NotAField::class, 'model1');
    }


    /**
     * @test
     * @covers \FormSchema\Generator\Field::getSchema
     */
    public function getSchema_returns_the_field_instance(){
        $fieldSchema = $this->prophesize(FieldSchema::class);

        $field = new FieldGenerator($fieldSchema->reveal());
        $this->assertEquals($fieldSchema->reveal(), $field->getSchema());
    }

    /**
     * @test
     * @covers \FormSchema\Generator\Field::input
     */
    public function input_creates_an_input_field(){
        $field = FieldGenerator::input('model1');
        $fieldReflection = new ReflectionClass(FieldGenerator::class);
        $fieldReflectionProperty = $fieldReflection->getProperty('field');
        $fieldReflectionProperty->setAccessible(true);
        $this->assertInstanceOf(InputField::class, $fieldReflectionProperty->getValue($field));
    }

    /**
     * @test
     * @covers \FormSchema\Generator\Field::__call
     */
    public function calls_are_forwarded_to_the_field_schema(){
        $fieldSchema = $this->prophesize(DummyField::class);
        $fieldSchema->model('aa')->shouldBeCalled();
        $fieldSchema->attribute('bb')->shouldBeCalled();
        $fieldSchema->label('cc')->shouldBeCalled();
        $fieldSchema->hint('dd')->shouldBeCalled();
        $fieldSchema->help('ee')->shouldBeCalled();

        $field = new FieldGenerator($fieldSchema->reveal());
        $field->model('aa');
        $field->attribute('bb');
        $field->label('cc');
        $field->hint('dd');
        $field->help('ee');
    }
}

class DummyField extends Field {

    public function getAttribute($name) {
        return $this->{$name};
    }

    public function model($var)
    {
        $this->model = $var;
    }

    public function attribute($var)
    {
        $this->attribute = $var;
    }

    public function label($var)
    {
        $this->label = $var;
    }

    public function hint($var)
    {
        $this->hint = $var;
    }

    public function help($var)
    {
        $this->help = $var;
    }

    public function getAppendedAttributes(): array
    {
        return [];
    }

    public function getType(): string
    {
        return 'dummy';
    }
}

class NotAField {

}
