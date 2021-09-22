<?php


namespace FormSchema\Tests\Unit\Schema;


use FormSchema\Schema\Field;
use FormSchema\Tests\TestCase;

class FieldTest extends TestCase
{

    /**
     * @test
     * @covers \FormSchema\Schema\Field::__call
     */
    public function __call_returns_an_attribute_if_function_getAttribute_is_defined(){
        $field = new class extends Field {
            public function getAppendedAttributes(): array { return []; }

            public function getTestAttribute()
            {
                return 'This is a test attribute';
            }
        };

        $this->assertEquals('This is a test attribute', $field->testAttribute());

    }

    /**
     * @test
     * @covers \FormSchema\Schema\Field::__call
     */
    public function __call_returns_an_attribute_if_the_attribute_exists_and_no_function_defined(){
        $field = new class extends Field {
            public function getAppendedAttributes(): array { return []; }
                protected $testAttribute = 'This is a test attribute set in a property';
        };

        $this->assertEquals('This is a test attribute set in a property', $field->testAttribute());
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Field::__call
     */
    public function __call_prioritises_the_getAttribute_function_over_the_attribute(){
        $field = new class extends Field {
            public function getAppendedAttributes(): array { return []; }
            protected $testAttribute = 'This is a test attribute set in a property';

            public function getTestAttribute()
            {
                return 'This is a test attribute';
            }
        };

        $this->assertEquals('This is a test attribute', $field->testAttribute());
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Field::__call
     */
    public function __call_sets_an_attribute_if_a_setAttribute_function_is_defined(){
        $field = new class extends Field {
            public function getAppendedAttributes(): array { return []; }
            public $val;
            public function setTestAttribute($val)
            {
                $this->val = $val . 'Set through function';
            }
        };
        $field->testAttribute('Test attribute');
        $this->assertEquals('Test attributeSet through function', $field->val );
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Field::__call
     */
    public function __call_sets_an_attribute_if_the_attribute_is_defined(){
        $field = new class extends Field {
            public function getAppendedAttributes(): array { return []; }
            public $val;
        };
        $field->val('Test attribute');
        $this->assertEquals('Test attribute', $field->val );
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Field::__call
     */
    public function __call_prioritises_the_setAttribute_function_over_the_direct_attribute_setting(){
        $field = new class extends Field {
            public function getAppendedAttributes(): array { return []; }
            public $val;
            public function setVal($val)
            {
                $this->val = $val . 'Set through function';
            }
        };
        $field->val('Test attribute');
        $this->assertEquals('Test attributeSet through function', $field->val );
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Field::toArray
     */
    public function toArray_returns_all_core_fields(){
        $field = new class extends Field {
            public function getType(): string
            {
                return 'dummy';
            }

            protected $label = 'label1';
            protected $model = 'model1';
            protected $id = 'id1';
            protected $inputName = 'inputName1';
            protected $featured = 'featured1';
            protected $visible = 'visible1';
            protected $disabled = 'disabled1';
            protected $required = 'required1';
            protected $multi = 'multi1';
            protected $default = 'default1';
            protected $hint = 'hint1';
            protected $help = 'help1';
            protected $styleClasses = 'styleClasses1';
            protected $buttons = 'buttons1';
            protected $attributes = 'attributes1';

            public function getAppendedAttributes(): array {return [];}
        };
        $this->assertEquals([
            'type' => 'type1',
            'label' => 'label1',
            'model' => 'model1',
            'id' => 'id1',
            'inputName' => 'inputName1',
            'featured' => 'featured1',
            'visible' => 'visible1',
            'disabled' => 'disabled1',
            'required' => 'required1',
            'multi' => 'multi1',
            'default' => 'default1',
            'hint' => 'hint1',
            'help' => 'help1',
            'styleClasses' => 'styleClasses1',
            'buttons' => 'buttons1',
            'attributes' => 'attributes1',
        ], $field->toArray());

    }

    /**
     * @test
     * @covers \FormSchema\Schema\Field::toArray
     */
    public function toArray_does_not_return_null_core_fields(){
        $field = new class extends Field {
            protected $label = 'label1';
            protected $model = 'model1';
            protected $id = 'id1';
            protected $visible = 'visible1';
            protected $disabled = 'disabled1';
            protected $required = 'required1';
            protected $hint = 'hint1';
            protected $help = 'help1';
            protected $buttons = 'buttons1';

            public function getAppendedAttributes(): array {return [];}
        };
        $this->assertEquals([
            'label' => 'label1',
            'model' => 'model1',
            'id' => 'id1',
            'visible' => 'visible1',
            'disabled' => 'disabled1',
            'required' => 'required1',
            'hint' => 'hint1',
            'help' => 'help1',
            'buttons' => 'buttons1',
        ], $field->toArray());

    }

    /**
     * @test
     * @covers \FormSchema\Schema\Field::toArray
     * @covers \FormSchema\Schema\Field::setCustomField
     */
    public function toArray_returns_any_additional_set_fields(){
        $field = new class extends Field {
            public function getType(): string
            {
                return 'dummy';
            }

            public function getAppendedAttributes(): array {return [];}
        };
        $field->setCustomField('someAdditionalField', 'FieldValue');
        $this->assertEquals([

            'someAdditionalField' => 'FieldValue'
        ], $field->toArray());
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Field::toArray
     */
    public function toArray_returns_any_attributes_from_the_field_type(){
        $field = new class extends Field {
            protected $specialFieldSchema;

            public function getType(): string
            {
                return 'dummy';
            }

            public function getAppendedAttributes(): array {
                return [
                    'specialFieldSchema' => $this->specialFieldSchema()
                ];
            }
        };

        $field->specialFieldSchema('somevalue');

        $this->assertEquals([
            'specialFieldSchema' => 'somevalue'
        ], $field->toArray());
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Field::toArray
     */
    public function toArray_does_not_return_any_null_attributes_from_the_field_type(){
        $field = new class extends Field {
            protected $specialFieldSchema;
            protected $emptySpecialFieldSchema;

            public function getAppendedAttributes(): array {
                return [
                    'specialFieldSchema' => $this->specialFieldSchema(),
                    'emptySpecialFieldSchema' => $this->emptySpecialFieldSchema()
                ];
            }
        };

        $field->specialFieldSchema('somevaluehere');
        $this->assertEquals([
            'specialFieldSchema' => 'somevaluehere'
        ], $field->toArray());
    }


    /**
     * @test
     * @covers \FormSchema\Schema\Field::toArray
     */
    public function toArray_prioritises_additional_fields_over_the_core_fields(){
        $field = new class extends Field {
            public function getType(): string
            {
                return 'dummy';
            }

            public function getAppendedAttributes(): array {return [];}
        };
        $field->label('SomeInitialLabel');
        $field->setCustomField('label', 'SomeLabel');
        $this->assertEquals([
            'label' => 'SomeLabel',
        ], $field->toArray());
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Field::toArray
     */
    public function toArray_prioritises_field_attributes_over_additional_fields(){
        $field = new class extends Field {
            protected $testValue;

            public function getType(): string
            {
                return 'dummy';
            }

            public function getAppendedAttributes(): array {return [
                'customField' => $this->testValue
            ];}
        };
        $field->testValue('testValue');
        $field->setCustomField('customField', 'initialTestValue');
        $this->assertEquals([
            'customField' => 'testValue',
        ], $field->toArray());
    }

    /**
     * @test
     * @covers \FormSchema\Schema\Field::toArray
     */
    public function toArray_prioritises_field_attributes_over_core_fields(){
        $field = new class extends Field {
            protected $label;

            public function getType(): string
            {
                return 'dummy';
            }

            public function getAppendedAttributes(): array {return [
                'label' => $this->label . 'fromField'
            ];}
        };
        $field->label('testValue');
        $this->assertEquals([
            'label' => 'testValuefromField',
        ], $field->toArray());
    }


}
