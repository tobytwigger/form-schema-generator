<?php

namespace FormSchema;

use FormSchema\Transformers\TransformerManager;
use Illuminate\Support\ServiceProvider;

class FormSchemaGeneratorServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(TransformerManager::class);
    }

    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/form-schema.php' => config_path('form-schema.php'),
        ], ['form-schema', 'config']);

        $this->mergeConfigFrom(
            __DIR__ . '/../config/form-schema.php',
            'form-schema'
        );
    }

}
