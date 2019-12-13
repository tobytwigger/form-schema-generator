<?php

namespace FormSchema\Tests\Unit\Generator;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use FormSchema\Generator\Field as FieldGenerator;
use FormSchema\Generator\Form as FormGenerator;
use FormSchema\Generator\Group as GroupGenerator;
use FormSchema\Schema\Field as FieldSchema;
use FormSchema\Schema\Form as FormSchema;
use FormSchema\Schema\Group as GroupSchema;

class FormTest extends TestCase
{

    /** 
     * @test
     * @covers \FormSchema\Generator\Form::make 
     */
    public function make_returns_a_form_instance()
    {
        $form = FormGenerator::make();
        $this->assertInstanceOf(FormGenerator::class, $form);
    }

    /** 
     * @test
     * @covers \FormSchema\Generator\Form::make
     * @covers \FormSchema\Generator\Form::__construct 
     */
    public function make_passes_a_form_schema_instance_to_the_form_generator()
    {
        $form = FormGenerator::make();
        $formReflection = new ReflectionClass(FormGenerator::class);
        $formReflectionProperty = $formReflection->getProperty('form');
        $formReflectionProperty->setAccessible(true);
        $this->assertInstanceOf(FormSchema::class, $formReflectionProperty->getValue($form));
    }

    /** 
     * @test
     * @covers \FormSchema\Generator\Form::withGroup 
     */
    public function withGroup_pushes_a_group_schema_to_the_form(){
        $formSchema = $this->prophesize(FormSchema::class);
        $groupSchema = $this->prophesize(GroupSchema::class);
        $groupGenerator = $this->prophesize(GroupGenerator::class);
        
        $groupGenerator->getSchema()->shouldBeCalled()->willReturn($groupSchema->reveal());
        $formSchema->addGroup($groupSchema->reveal())->shouldBeCalled();
        
        $form = new FormGenerator($formSchema->reveal());
        $form->withGroup($groupGenerator->reveal());
    }

    /** 
     * @test
     * @covers \FormSchema\Generator\Form::withField 
     */
    public function withField_pushes_a_field_schema_to_the_form(){
        $formSchema = $this->prophesize(FormSchema::class);
        $fieldSchema = $this->prophesize(FieldSchema::class);
        $fieldGenerator = $this->prophesize(FieldGenerator::class);

        $fieldGenerator->getSchema()->shouldBeCalled()->willReturn($fieldSchema->reveal());
        $formSchema->addField($fieldSchema->reveal())->shouldBeCalled();

        $form = new FormGenerator($formSchema->reveal());
        $form->withField($fieldGenerator->reveal());
    }
    
    /** 
     * @test
     * @covers \FormSchema\Generator\Form::getSchema 
     */
    public function getSchema_returns_the_form_instance(){
        $formSchema = $this->prophesize(FormSchema::class);
        
        $form = new FormGenerator($formSchema->reveal());
        $this->assertEquals($formSchema->reveal(), $form->getSchema());
    }

    /** 
     * @test
     * @covers \FormSchema\Generator\Form::__toString 
     */
    public function __toString_calls_get_schema_and_casts_to_a_string()
    {
        $formSchema = $this->prophesize(FormSchema::class);
        $formSchema->__toString()->shouldBeCalled()->willReturn('teststring');
        
        $form = new FormGenerator($formSchema->reveal());
        $this->assertEquals('teststring', (string) $form);
    }

}