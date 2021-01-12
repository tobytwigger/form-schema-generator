<?php


namespace FormSchema\Tests\Unit\Schema;


use FormSchema\Schema\Field;
use FormSchema\Schema\Form;
use FormSchema\Schema\Group;
use FormSchema\Tests\TestCase;

class GroupTest extends TestCase
{

    /**
     * @test
     * @covers \FormSchema\Schema\Group::addField
     */
    public function addField_adds_a_field_to_the_group(){
        $group = new Group();
        $field1 = new DummyField();
        $field2 = new DummyField();

        $group->addField($field1);
        $group->addField($field2);

        $reflectionClass = new \ReflectionClass(Group::class);
        $fieldProperty = $reflectionClass->getProperty('fields');
        $fieldProperty->setAccessible(true);
        $fields = $fieldProperty->getValue($group);

        $this->assertEquals([$field1, $field2], $fields);
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Group::fields
     */
    public function fields_returns_all_fields_for_the_group(){
        $group = new Group();
        $field1 = new DummyField();
        $field2 = new DummyField();

        $group->addField($field1);
        $group->addField($field2);

        $this->assertEquals([$field1, $field2], $group->fields());
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Group::setLegend
     */
    public function setLegend_sets_the_legend_for_the_group(){
        $group = new Group();
        $group->setLegend('Legend 1');

        $groupReflection = new \ReflectionClass(Group::class);
        $legendProperty = $groupReflection->getProperty('legend');
        $legendProperty->setAccessible(true);
        $this->assertEquals('Legend 1', $legendProperty->getValue($group));
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Group::toArray
     */
    public function toArray_returns_the_fields_and_the_legend_as_an_array(){
        $field1 = $this->prophesize(Field::class);
        $field2 = $this->prophesize(Field::class);

        $field1->toArray()->shouldBeCalled()->willReturn(['key' => 'field1']);
        $field2->toArray()->shouldBeCalled()->willReturn(['key' => 'field2']);

        $group = new Group();
        $group->addField($field1->reveal());
        $group->addField($field2->reveal());
        $group->setLegend('Legend 1');

        $this->assertEquals([
            'legend' => 'Legend 1',
            'fields' => [['key' => 'field1'], ['key' => 'field2']]
        ], $group->toArray());
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Group::toJson
     */
    public function toJson_returns_the_fields_and_the_legend_as_json(){
        $field1 = $this->prophesize(Field::class);
        $field2 = $this->prophesize(Field::class);

        $field1->toArray()->shouldBeCalled()->willReturn(['key' => 'field1']);
        $field2->toArray()->shouldBeCalled()->willReturn(['key' => 'field2']);

        $group = new Group();
        $group->addField($field1->reveal());
        $group->addField($field2->reveal());
        $group->setLegend('Legend 12');

        $this->assertEquals(json_encode([
            'legend' => 'Legend 12',
            'fields' => [['key' => 'field1'], ['key' => 'field2']]
        ]), $group->toJson());
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Group::__toString
     */
    public function __toString_returns_the_fields_and_the_legend_as_json(){
        $field1 = $this->prophesize(Field::class);
        $field2 = $this->prophesize(Field::class);

        $field1->toArray()->shouldBeCalled()->willReturn(['key' => 'field1']);
        $field2->toArray()->shouldBeCalled()->willReturn(['key' => 'field2']);

        $group = new Group();
        $group->addField($field1->reveal());
        $group->addField($field2->reveal());
        $group->setLegend('Legend 31');

        $this->assertEquals(json_encode([
            'legend' => 'Legend 31',
            'fields' => [['key' => 'field1'], ['key' => 'field2']]
        ]), (string) $group);
    }

}
