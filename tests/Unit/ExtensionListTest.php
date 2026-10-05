<?php

namespace Takepartdev\LaravelFhir\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Extension;
use Takepartdev\LaravelFhir\Tests\TestCase;

class ExtensionListTest extends TestCase
{
    private const string SRC_DIR = __DIR__ . '/../../src';

    private const string NAMESPACE_PREFIX = 'Takepartdev\\LaravelFhir\\';

    public static function classesWithSetter(string $setter): array
    {
        $cases = [];
        $srcDir = realpath(self::SRC_DIR);
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($srcDir, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($files as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }

            $relative = substr($file->getPathname(), strlen($srcDir) + 1);
            $class = self::NAMESPACE_PREFIX . str_replace(['/', '.php'], ['\\', ''], $relative);

            if (! class_exists($class) || ! is_subclass_of($class, AbstractResource::class)) {
                continue;
            }

            $reflection = new ReflectionClass($class);

            if ($reflection->isAbstract() || ! $reflection->hasMethod($setter)) {
                continue;
            }

            $cases[$class] = [$class];
        }

        ksort($cases);

        return $cases;
    }

    public static function extensionClasses(): array
    {
        return self::classesWithSetter('setExtension');
    }

    public static function modifierExtensionClasses(): array
    {
        return self::classesWithSetter('setModifierExtension');
    }

    #[DataProvider('extensionClasses')]
    public function test_set_extension_appends_to_a_list(string $class): void
    {
        $this->assertSetterAppends(new $class, 'setExtension', 'extension');
    }

    #[DataProvider('modifierExtensionClasses')]
    public function test_set_modifier_extension_appends_to_a_list(string $class): void
    {
        $this->assertSetterAppends(new $class, 'setModifierExtension', 'modifierExtension');
    }

    private function assertSetterAppends(AbstractResource $resource, string $setter, string $key): void
    {
        $first = new Extension;
        $first->setUrl('http://example.org/fhir/StructureDefinition/first');
        $first->setValueString('first');

        $second = new Extension;
        $second->setUrl('http://example.org/fhir/StructureDefinition/second');
        $second->setValueString('second');

        $resource->$setter($first);
        $resource->$setter($second);

        $this->assertSame(
            [
                ['url' => 'http://example.org/fhir/StructureDefinition/first', 'valueString' => 'first'],
                ['url' => 'http://example.org/fhir/StructureDefinition/second', 'valueString' => 'second'],
            ],
            $resource->toArray()[$key],
            $resource::class . "::$setter must append so '$key' serializes as a JSON array",
        );
    }
}
