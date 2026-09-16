<?php

namespace Takepartdev\LaravelFhir\Tests\Extensions;

use PHPUnit\Event\Application\Finished;
use PHPUnit\Event\Application\FinishedSubscriber;
use PHPUnit\Event\Code\TestMethod;
use PHPUnit\Event\Test\Errored;
use PHPUnit\Event\Test\ErroredSubscriber;
use PHPUnit\Event\Test\Failed;
use PHPUnit\Event\Test\FailedSubscriber;
use PHPUnit\Runner\Extension\Extension;
use PHPUnit\Runner\Extension\Facade;
use PHPUnit\Runner\Extension\ParameterCollection;
use PHPUnit\TextUI\Configuration\Configuration;

final class FailedFixtureSummary implements Extension
{
    public function bootstrap(Configuration $configuration, Facade $facade, ParameterCollection $parameters): void
    {
        $facade->registerSubscribers(
            new class implements FailedSubscriber
            {
                public function notify(Failed $event): void
                {
                    $test = $event->test();

                    if ($test instanceof TestMethod) {
                        FailedFixtureCollector::record($test);
                    }
                }
            },
            new class implements ErroredSubscriber
            {
                public function notify(Errored $event): void
                {
                    $test = $event->test();

                    if ($test instanceof TestMethod) {
                        FailedFixtureCollector::record($test);
                    }
                }
            },
            new class implements FinishedSubscriber
            {
                public function notify(Finished $event): void
                {
                    FailedFixtureSummary::render(FailedFixtureCollector::failures());
                }
            },
        );
    }

    /**
     * @param  array<int, array{resource: string, file: string}>  $failures
     */
    public static function render(array $failures): void
    {
        if ($failures === []) {
            return;
        }

        $resourceWidth = max(array_map(
            static fn (array $failure): int => strlen($failure['resource']),
            [...$failures, ['resource' => 'RESOURCE', 'file' => '']],
        ));

        printf('%sFailing fixtures (%d)%s%s', PHP_EOL, count($failures), PHP_EOL, PHP_EOL);
        printf('  %s  %s%s', str_pad('RESOURCE', $resourceWidth), 'FILE', PHP_EOL);

        foreach ($failures as $failure) {
            printf('  %s  %s%s', str_pad($failure['resource'], $resourceWidth), $failure['file'], PHP_EOL);
        }

        echo PHP_EOL;
    }
}
