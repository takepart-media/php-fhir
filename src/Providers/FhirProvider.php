<?php

namespace Takepartdev\LaravelFhir\Providers;

use Illuminate\Support\ServiceProvider;

class FhirProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(dirname(__DIR__).'/Config/config.php', 'fhir');
    }
}
