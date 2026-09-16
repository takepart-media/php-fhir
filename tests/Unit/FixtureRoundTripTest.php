<?php

namespace Takepartdev\LaravelFhir\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use RuntimeException;
use Takepartdev\LaravelFhir\FhirObject;
use Takepartdev\LaravelFhir\Tests\Extensions\FailedFixtureCollector;
use Takepartdev\LaravelFhir\Tests\TestCase;
use Takepartdev\LaravelFhir\Traits\TestWithProvidedJsonFiles;

class FixtureRoundTripTest extends TestCase
{
    use TestWithProvidedJsonFiles;

    public static function fixtureProvider(): array
    {
        $directories = glob(self::fixturePath('*'), GLOB_ONLYDIR);

        if ($directories === false || $directories === []) {
            throw new RuntimeException('No fixture directories found in ' . self::fixturePath());
        }

        $cases = [];

        foreach ($directories as $directory) {
            $resource = basename($directory);
            $files = self::getFiles($directory);

            if ($files->isEmpty()) {
                throw new RuntimeException("Fixture directory '$resource' contains no JSON files");
            }

            foreach ($files as $file => $arguments) {
                $cases[$resource . FailedFixtureCollector::DELIMITER . $file] = [$arguments[0]];
            }
        }

        return $cases;
    }

    #[DataProvider('fixtureProvider')]
    public function test_fixture_round_trips_through_fhir_object(string $path): void
    {
        $data = self::loadJson($path);

        $object = new FhirObject($data);

        $this->assertJsonStringEqualsJsonString(
            json_encode($data),
            json_encode($object->toFhir()->toArray()),
        );
    }
}
