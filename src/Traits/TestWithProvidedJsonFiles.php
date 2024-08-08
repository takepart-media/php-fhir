<?php

namespace Takepartdev\LaravelFhir\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Takepartdev\LaravelFhir\Exceptions\NotFoundException;

trait TestWithProvidedJsonFiles
{
    /**
     * @throws NotFoundException
     */
    public static function loadJson(string $path): array
    {
        if (! File::exists($path)) {
            throw new NotFoundException('Invalid File');
        }

        return json_decode(File::get($path), true);
    }

    public static function getFiles(string $path): Collection
    {
        $jsonFiles = scandir(realpath($path));

        return collect($jsonFiles)
            ->filter(function ($file) {
                return ! Str::startsWith($file, '.');
            })
            ->mapWithKeys(function ($file) use ($path) {
                return [$file => [realpath($path.'/'.$file)]];
            });
    }
}
