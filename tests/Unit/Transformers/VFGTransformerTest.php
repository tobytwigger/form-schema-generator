<?php


namespace FormSchema\Tests\Unit;


use FormSchema\Schema\Field;
use FormSchema\Schema\Form;
use FormSchema\Schema\Group;
use FormSchema\Transformers\VFGTransformer;
use FormSchema\Tests\TestCase;

class VFGTransformerTest extends TestCase
{

    /**
     * @test
     * @covers \FormSchema\Transformers\VFGTransformer::extractModel
     */
    public function extractModel_extracts_the_model_from_fields_in_a_form(){
        $field1 = $this->prophesize(DummyField::class);
        $field2 = $this->prophesize(DummyField::class);
        $field1->model()->shouldBeCalled()->willReturn('model1');
        $field2->model()->shouldBeCalled()->willReturn('model2');

        $form = $this->prophesize(Form::class);
        $form->fields()->shouldBeCalled()->willReturn([$field1->reveal(), $field2->reveal()]);
        $form->groups()->willReturn([]);

        $transformer = new VFGTransformer;
        $this->assertEquals([
            'model1' => null, 'model2' => null
        ], $transformer->extractModel($form->reveal()));
    }

    /**
     * @test
     * @covers \FormSchema\Transformers\VFGTransformer::extractModel
     */
    public function extractModel_extracts_the_model_from_fields_in_a_group(){
        $field1 = $this->prophesize(DummyField::class);
        $field2 = $this->prophesize(DummyField::class);
        $field1->model()->shouldBeCalled()->willReturn('model1');
        $field2->model()->shouldBeCalled()->willReturn('model2');

        $group = $this->prophesize(Group::class);
        $group->fields()->shouldBeCalled()->willReturn([$field1->reveal(), $field2->reveal()]);

        $transformer = new VFGTransformer();
        $this->assertEquals([
            'model1' => null, 'model2' => null
        ], $transformer->extractModel($group->reveal()));
    }

    /**
     * @test
     * @covers \FormSchema\Transformers\VFGTransformer::extractModel
     */
    public function extractModel_extracts_the_model_from_groups_in_a_form(){
        $field1 = $this->prophesize(DummyField::class);
        $field2 = $this->prophesize(DummyField::class);
        $field3 = $this->prophesize(DummyField::class);
        $field4 = $this->prophesize(DummyField::class);
        $field5 = $this->prophesize(DummyField::class);
        $field1->model()->shouldBeCalled()->willReturn('model1');
        $field2->model()->shouldBeCalled()->willReturn('model2');
        $field3->model()->shouldBeCalled()->willReturn('model3');
        $field4->model()->shouldBeCalled()->willReturn('model4');
        $field5->model()->shouldBeCalled()->willReturn('model5');

        $group1 = $this->prophesize(Group::class);
        $group2 = $this->prophesize(Group::class);
        $group1->fields()->shouldBeCalled()->willReturn([$field2->reveal(), $field3->reveal()]);
        $group2->fields()->shouldBeCalled()->willReturn([$field4->reveal(), $field5->reveal()]);

        $form = $this->prophesize(Form::class);
        $form->fields()->shouldBeCalled()->willReturn([$field1->reveal()]);
        $form->groups()->willReturn([$group1->reveal(), $group2->reveal()]);

        $transformer = new VFGTransformer;
        $this->assertEquals([
            'model1' => null, 'model2' => null, 'model3' => null, 'model4' => null, 'model5' => null
        ], $transformer->extractModel($form->reveal()));
    }

    /**
     * @test
     * @covers \FormSchema\Transformers\VFGTransformer::extractOptions
     */
    public function extractOptions_returns_an_array(){
        $form = $this->prophesize(Form::class);
        $transformer = new VFGTransformer();
        $this->assertEquals([
	    'validateDebounceTime' => 0
	], $transformer->extractOptions($form->reveal()));
    }

    /**
     * @test
     * @covers \FormSchema\Transformers\VFGTransformer::transformToArray
     */
    public function transformToArray_transforms_the_schema_to_an_array(){
        $field1 = $this->prophesize(DummyField::class);
        $field2 = $this->prophesize(DummyField::class);
        $field1->model()->shouldBeCalled()->willReturn('model1');
        $field2->model()->shouldBeCalled()->willReturn('model2');

        $form = $this->prophesize(Form::class);
        $form->toArray()->shouldBeCalled()->willReturn(['some' => 'schema']);
        $form->fields()->shouldBeCalled()->willReturn([$field1->reveal(), $field2->reveal()]);
        $form->groups()->willReturn([]);

        $transformer = new VFGTransformer;
        $this->assertEquals([
            'schema' => ['some' => 'schema'],
            'model' => ['model1' => null, 'model2' => null],
            'options' => [
	        'validateDebounceTime' => 0
	    ]
        ], $transformer->transformToArray($form->reveal()));
    }

    /**
     * @test
     * @covers \FormSchema\Transformers\VFGTransformer::transformToJson
     */
    public function transformToJson_transforms_the_schema_to_an_json(){
        $field1 = $this->prophesize(DummyField::class);
        $field2 = $this->prophesize(DummyField::class);
        $field1->model()->shouldBeCalled()->willReturn('model1');
        $field2->model()->shouldBeCalled()->willReturn('model2');

        $form = $this->prophesize(Form::class);
        $form->toArray()->shouldBeCalled()->willReturn(['some' => 'schema']);
        $form->fields()->shouldBeCalled()->willReturn([$field1->reveal(), $field2->reveal()]);
        $form->groups()->willReturn([]);

        $transformer = new VFGTransformer;
        $this->assertEquals(json_encode([
            'schema' => ['some' => 'schema'],
            'model' => ['model1' => null, 'model2' => null],
            'options' => [
	        'validateDebounceTime' => 0
	    ]
        ]), $transformer->transformToJson($form->reveal()));
    }

}

class DummyField extends Field {

    public function getAppendedAttributes(): array
    {
        return [];
    }

    public function model()
    {

    }
}
