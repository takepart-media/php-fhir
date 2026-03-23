<?php

namespace Takepartdev\LaravelFhir\DataTypes\Timing;

use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Quantity;
use Takepartdev\LaravelFhir\DataTypes\Range;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class Repeat extends InternalResource
{
    protected string $name = 'TimingRepeat';

    public function __construct()
    {
        parent::__construct();
    }

    public function setBoundsDuration(Quantity $boundsDuration): void
    {
        $this->values['boundsDuration'] = $boundsDuration;
    }

    public function setBoundsRange(Range $boundsRange): void
    {
        $this->values['boundsRange'] = $boundsRange;
    }

    public function setBoundsPeriod(Period $boundsPeriod): void
    {
        $this->values['boundsPeriod'] = $boundsPeriod;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setCount(int $count): void
    {
        if ($this->validateInteger($count, '>', 0, "$this->name.count")) {
            $this->values['count'] = $count;
        } else {
            $this->values['hiddenProperties']['count'] = $count;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setCountMax(int $countMax): void
    {
        if ($this->validateInteger($countMax, '>', 0, "$this->name.countMax")) {
            $this->values['countMax'] = $countMax;
        } else {
            $this->values['hiddenProperties']['countMax'] = $countMax;
        }
    }

    public function setDuration(float $duration): void
    {
        $this->values['duration'] = $duration;
    }

    public function setDurationMax(float $durationMax): void
    {
        $this->values['durationMax'] = $durationMax;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDurationUnit(string $unit): void
    {
        if ($this->validateInArray($unit, ['s', 'min', 'h', 'd', 'wk', 'mo', 'a'], "$this->name.durationUnit")) {
            $this->values['durationUnit'] = $unit;
        } else {
            $this->values['hiddenProperties']['durationUnit'] = $unit;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setFrequency(int $frequency): void
    {
        if ($this->validateInteger($frequency, '>', 0, "$this->name.frequency")) {
            $this->values['frequency'] = $frequency;
        } else {
            $this->values['hiddenProperties']['frequency'] = $frequency;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setFrequencyMax(int $frequencyMax): void
    {
        if ($this->validateInteger($frequencyMax, '>', 0, "$this->name.frequencyMax")) {
            $this->values['frequencyMax'] = $frequencyMax;
        } else {
            $this->values['hiddenProperties']['frequencyMax'] = $frequencyMax;
        }
    }

    public function setPeriod(float $period): void
    {
        $this->values['period'] = $period;
    }

    public function setPeriodMax(float $periodMax): void
    {
        $this->values['periodMax'] = $periodMax;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setPeriodUnit(string $unit): void
    {
        if ($this->validateInArray($unit, ['s', 'min', 'h', 'd', 'wk', 'mo', 'a'], "$this->name.periodUnit")) {
            $this->values['periodUnit'] = $unit;
        } else {
            $this->values['hiddenProperties']['periodUnit'] = $unit;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDayOfWeek(string $day): void
    {
        if ($this->validateInArray($day, ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'], "$this->name.dayOfWeek")) {
            $this->initArrayProperty('dayOfWeek');
            $this->values['dayOfWeek'][] = $day;
        } else {
            $this->values['hiddenProperties']['dayOfWeek'][] = $day;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setWhen(string $code): void
    {
        if ($this->validateCode($code, "$this->name.when")) {
            $this->initArrayProperty('when');
            $this->values['when'][] = $code;
        } else {
            $this->values['hiddenProperties']['when'][] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setOffset(int $offset): void
    {
        if ($this->validateInteger($offset, '>=', 0, "$this->name.offset")) {
            $this->values['offset'] = $offset;
        } else {
            $this->values['hiddenProperties']['offset'] = $offset;
        }
    }
}
