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

class GroupTest extends TestCase
{

    /** 
     * @test 
     * @covers \FormSchema\Generator\Group::make
     */
    public function make_returns_a_group_generator_instance()
    {
        $group = GroupGenerator::make();
        $this->assertInstanceOf(GroupGenerator::class, $group);
    }

    /** 
     * @test
     * @covers \FormSchema\Generator\Group::make
     * @covers \FormSchema\Generator\Group::__construct 
     */
    public function make_passes_a_group_schema_instance_to_the_group_generator()
    {
        $group = GroupGenerator::make();
        $groupReflection = new ReflectionClass(GroupGenerator::class);
        $groupReflectionProperty = $groupReflection->getProperty('group');
        $groupReflectionProperty->setAccessible(true);
        $this->assertInstanceOf(GroupSchema::class, $groupReflectionProperty->getValue($group));
    }

    /** 
     * @test
     * @covers \FormSchema\Generator\Group::withField 
     */
    public function withField_pushes_a_field_schema_to_the_group(){
        $groupSchema = $this->prophesize(GroupSchema::class);
        $fieldSchema = $this->prophesize(FieldSchema::class);
        $fieldGenerator = $this->prophesize(FieldGenerator::class);

        $fieldGenerator->getSchema()->shouldBeCalled()->willReturn($fieldSchema->reveal());
        $groupSchema->addField($fieldSchema->reveal())->shouldBeCalled();

        $group = new GroupGenerator($groupSchema->reveal());
        $group->withField($fieldGenerator->reveal());
    }


    /** 
     * @test
     * @covers \FormSchema\Generator\Group::legend 
     */
    public function legend_sets_the_legend(){
        $groupSchema = $this->prophesize(GroupSchema::class);
        $groupSchema->setLegend('Test Legend')->shouldBeCalled();

        $group = new GroupGenerator($groupSchema->reveal());
        $group->legend('Test Legend');
    }

    
    /** 
     * @test
     * @covers \FormSchema\Generator\Group::getSchema 
     */
    public function getSchema_returns_the_group_instance(){
        $groupSchema = $this->prophesize(GroupSchema::class);

        $group = new GroupGenerator($groupSchema->reveal());
        $this->assertEquals($groupSchema->reveal(), $group->getSchema());
    }
    
}