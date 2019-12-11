<?php

namespace FormSchema\Tests\Integration;

use PHPUnit\Framework\TestCase;
use FormSchema\Generator\Field;
use FormSchema\Generator\Form;
use FormSchema\Generator\Group;

class Test extends TestCase
{

    /** @test */
    public function test(){
        $result = Form::make()
            ->withGroup(
                Group::make()->legend('First Legend')->withField(
                    Field::input('model1')
                        ->inputType('text'))
            )->withGroup(
                Group::make()->withField(
                    Field::input('model2')
                )
            )->withField(
                Field::input('model3')
        );
        echo $result;
    }
    
}