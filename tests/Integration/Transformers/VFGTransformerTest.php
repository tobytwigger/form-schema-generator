<?php

namespace FormSchema\Tests\Integration\Transformers;

use FormSchema\Generator\Field;
use FormSchema\Generator\Form;
use FormSchema\Generator\Group;
use PHPUnit\Framework\TestCase;

class VFGTransformerTest extends TestCase
{

    /** @test */
    public function vfgTransformer_can_extract_a_model()
    {
        $form = Form::make()->withGroup(
            Group::make()->legend('Group 1')->withField(
                Field::input('model1')
            )->withField(
                Field::input('model2')
            )
        )->withGroup(
            Group::make()->legend('Group 1')->withField(
                Field::input('model3')
            )->withField(
                Field::input('model4')
            )
        )->withField(
            Field::input('model5')
        )->getSchema();

        $vfgTransformer = new \FormSchema\Transformers\VFGTransformer;
        $model = $vfgTransformer->extractModel($form);
        $this->assertEquals([
            'model1' => null, 'model2' => null, 'model3' => null, 'model4' => null, 'model5' => null,
        ], $model);
    }

    /** @test */
    public function vfgTransformer_can_return_the_correct_array()
    {
        $form = Form::make()->withGroup(
            Group::make()->legend('Group 1')->withField(
                Field::input('model1')
            )->withField(
                Field::input('model2')
            )
        )->withGroup(
            Group::make()->legend('Group 2')->withField(
                Field::input('model3')
            )->withField(
                Field::input('model4')
            )
        )->withField(
            Field::input('model5')->inputType('text')->label('An Input')
        )->getSchema();

        $vfgTransformer = new \FormSchema\Transformers\VFGTransformer;
        $this->assertEquals([
            'schema' => [
                'fields' => [
                    [
                        'type' => 'input',
                        'model' => 'model5',
                        'inputType' => 'text',
                        'label' => 'An Input'   
                    ]
                ],
                'groups' => [
                    [
                        'legend' => 'Group 1',
                        'fields' => [
                            ['type' => 'input', 'model' => 'model1'],
                            ['type' => 'input', 'model' => 'model2']
                        ]
                    ],
                    [
                        'legend' => 'Group 2',
                        'fields' => [
                            ['type' => 'input', 'model' => 'model3'],
                            ['type' => 'input', 'model' => 'model4']
                        ]
                    ]
                ]
            ],
            'model' => [
                'model1' => null,
                'model2' => null,
                'model3' => null,
                'model4' => null,
                'model5' => null,
            ],
            'options' => []
        ], $vfgTransformer->transformToArray($form));
        
    }

    /** @test */
    public function vfgTransformer_can_return_the_correct_json()
    {
        $form = Form::make()->withGroup(
            Group::make()->legend('Group 1')->withField(
                Field::input('model1')
            )->withField(
                Field::input('model2')
            )
        )->withGroup(
            Group::make()->legend('Group 2')->withField(
                Field::input('model3')
            )->withField(
                Field::input('model4')
            )
        )->withField(
            Field::input('model5')->inputType('text')->label('An Input')
        )->getSchema();

        $vfgTransformer = new \FormSchema\Transformers\VFGTransformer;
        $this->assertEquals(json_encode([
            'schema' => [
                'fields' => [
                    [
                        'type' => 'input',
                        'label' => 'An Input',
                        'model' => 'model5',
                        'inputType' => 'text'
                    ]
                ],
                'groups' => [
                    [
                        'legend' => 'Group 1',
                        'fields' => [
                            ['type' => 'input', 'model' => 'model1'],
                            ['type' => 'input', 'model' => 'model2']
                        ]
                    ],
                    [
                        'legend' => 'Group 2',
                        'fields' => [
                            ['type' => 'input', 'model' => 'model3'],
                            ['type' => 'input', 'model' => 'model4']
                        ]
                    ]
                ]
            ],
            'model' => [
                'model5' => null,
                'model1' => null,
                'model2' => null,
                'model3' => null,
                'model4' => null,
            ],
            'options' => []
        ]), $vfgTransformer->transformToJson($form));

    }


}