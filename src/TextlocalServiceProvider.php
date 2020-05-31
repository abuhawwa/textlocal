<?php

namespace Abuhawwa\Textlocal;

use Illuminate\Support\ServiceProvider;

class TextlocalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/textlocal.php' => config_path('textlocal.php')
        ], 'textlocal');
    }
}
