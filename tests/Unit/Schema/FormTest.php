<?php


namespace FormSchema\Tests\Unit\Schema;


use FormSchema\Schema\Field;
use FormSchema\Schema\Form;
use FormSchema\Schema\Group;
use FormSchema\Tests\TestCase;

class FormTest extends TestCase
{

    /**
     * @test
     * @covers \FormSchema\Schema\Form::addGroup
     */
    public function addGroup_adds_a_group_to_the_form(){
        $form = new Form();
        $group1 = new Group();
        $group1->setLegend('Legend 1');
        $group2 = new Group();
        $group2->setLegend('Legend 2');

        $form->addGroup($group1);
        $form->addGroup($group2);

        $reflectionClass = new \ReflectionClass(Form::class);
        $groupProperty = $reflectionClass->getProperty('groups');
        $groupProperty->setAccessible(true);
        $groups = $groupProperty->getValue($form);

        $this->assertEquals([$group1, $group2], $groups);
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Form::addField
     */
    public function addField_adds_a_field_to_the_form(){
        $form = new Form();
        $field1 = new DummyField();
        $field2 = new DummyField();

        $form->addField($field1);
        $form->addField($field2);

        $reflectionClass = new \ReflectionClass(Form::class);
        $fieldProperty = $reflectionClass->getProperty('fields');
        $fieldProperty->setAccessible(true);
        $fields = $fieldProperty->getValue($form);

        $this->assertEquals([$field1, $field2], $fields);
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Form::fields
     */
    public function fields_returns_all_fields_for_the_form(){
        $form = new Form();
        $field1 = new DummyField();
        $field2 = new DummyField();

        $form->addField($field1);
        $form->addField($field2);

        $this->assertEquals([$field1, $field2], $form->fields());
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Form::groups
     */
    public function groups_returns_all_groups_for_the_form(){
        $form = new Form();
        $group1 = new Group();
        $group1->setLegend('Legend 1');
        $group2 = new Group();
        $group2->setLegend('Legend 2');

        $form->addGroup($group1);
        $form->addGroup($group2);

        $this->assertEquals([$group1, $group2], $form->groups());
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Form::toArray
     */
    public function toArray_returns_the_fields_and_the_groups_as_an_array(){
        $field1 = $this->prophesize(Field::class);
        $field2 = $this->prophesize(Field::class);
        $group1 = $this->prophesize(Group::class);
        $group2 = $this->prophesize(Group::class);

        $field1->toArray()->shouldBeCalled()->willReturn(['key' => 'field1']);
        $field2->toArray()->shouldBeCalled()->willReturn(['key' => 'field2']);
        $group1->toArray()->shouldBeCalled()->willReturn(['key' => 'group1']);
        $group2->toArray()->shouldBeCalled()->willReturn(['key' => 'group2']);

        $form = new Form();
        $form->addField($field1->reveal());
        $form->addField($field2->reveal());
        $form->addGroup($group1->reveal());
        $form->addGroup($group2->reveal());

        $this->assertEquals([
            'fields' => [['key' => 'field1'], ['key' => 'field2']],
            'groups' => [['key' => 'group1'], ['key' => 'group2']],
        ], $form->toArray());
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Form::toJson
     */
    public function toJson_returns_the_fields_and_the_groups_as_json(){
        $field1 = $this->prophesize(Field::class);
        $field2 = $this->prophesize(Field::class);
        $group1 = $this->prophesize(Group::class);
        $group2 = $this->prophesize(Group::class);

        $field1->toArray()->shouldBeCalled()->willReturn(['key' => 'field1']);
        $field2->toArray()->shouldBeCalled()->willReturn(['key' => 'field2']);
        $group1->toArray()->shouldBeCalled()->willReturn(['key' => 'group1']);
        $group2->toArray()->shouldBeCalled()->willReturn(['key' => 'group2']);

        $form = new Form();
        $form->addField($field1->reveal());
        $form->addField($field2->reveal());
        $form->addGroup($group1->reveal());
        $form->addGroup($group2->reveal());

        $this->assertEquals(json_encode([
            'fields' => [['key' => 'field1'], ['key' => 'field2']],
            'groups' => [['key' => 'group1'], ['key' => 'group2']],
        ]), $form->toJson());
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Form::__toString
     */
    public function __toString_returns_the_fields_and_the_groups_as_json(){
        $field1 = $this->prophesize(Field::class);
        $field2 = $this->prophesize(Field::class);
        $group1 = $this->prophesize(Group::class);
        $group2 = $this->prophesize(Group::class);

        $field1->toArray()->shouldBeCalled()->willReturn(['key' => 'field1']);
        $field2->toArray()->shouldBeCalled()->willReturn(['key' => 'field2']);
        $group1->toArray()->shouldBeCalled()->willReturn(['key' => 'group1']);
        $group2->toArray()->shouldBeCalled()->willReturn(['key' => 'group2']);

        $form = new Form();
        $form->addField($field1->reveal());
        $form->addField($field2->reveal());
        $form->addGroup($group1->reveal());
        $form->addGroup($group2->reveal());

        $this->assertEquals(json_encode([
            'fields' => [['key' => 'field1'], ['key' => 'field2']],
            'groups' => [['key' => 'group1'], ['key' => 'group2']],
        ]), (string) $form);
    }

}

class DummyField extends Field {

    public function getType(): string
    {
        return 'dummy';
    }

    public function getAppendedAttributes(): array
    {
        return [];
    }
}
