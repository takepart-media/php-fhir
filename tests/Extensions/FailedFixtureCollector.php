<?php

namespace Takepartdev\LaravelFhir\Tests\Extensions;

use PHPUnit\Event\Code\TestMethod;

final class FailedFixtureCollector
{
    public const DELIMITER = ' → ';

    /**
     * @var array<int, array{resource: string, file: string}>
     */
    private static array $failures = [];

    public static function record(TestMethod $test): void
    {
        $name = self::dataSetName($test);

        if ($name !== null && str_contains($name, self::DELIMITER)) {
            [$resource, $file] = explode(self::DELIMITER, $name, 2);
        } else {
            $resource = '-';
            $file = $name ?? $test->nameWithClass();
        }

        self::$failures[] = [
            'resource' => $resource,
            'file' => $file,
        ];
    }

    /**
     * @return array<int, array{resource: string, file: string}>
     */
    public static function failures(): array
    {
        return self::$failures;
    }

    private static function dataSetName(TestMethod $test): ?string
    {
        $data = $test->testData();

        if (! $data->hasDataFromDataProvider()) {
            return null;
        }

        return (string) $data->dataFromDataProvider()->dataSetName();
    }
}
