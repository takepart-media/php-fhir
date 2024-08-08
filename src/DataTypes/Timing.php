<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Timing extends AbstractResource
{
    protected string $name = 'Timing';

    public function __construct()
    {
        parent::__construct();
    }

    public function setExtension(Extension $extension): void
    {
        $this->values['extension'] = $extension;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setEvent(string $dateString): void
    {
        if ($this->validateDateTime($dateString, 'Timing.event')) {
            $this->initArrayProperty('event');
            $this->values['event'][] = $dateString;
        } else {
            $this->values['hiddenProperties']['event'][] = $dateString;
        }
    }

    public function setBoundsDuration($duration): void
    {
        $this->values['repeat']['boundsDuration'] = $duration;
    }

    public function setBoundsRange(Range $range): void
    {
        $this->values['repeat']['boundsRange'] = $range;
    }

    public function setBoundsPeriod(Period $period): void
    {
        $this->values['repeat']['boundsPeriod'] = $period;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setCount(int $count): void
    {
        if ($this->validateInteger($count, '>', 0, 'Timing.count')) {
            $this->values['repeat']['count'] = $count;
        } else {
            $this->values['hiddenProperties']['repeat']['count'] = $count;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setCountMax(int $countMax): void
    {
        if ($this->validateInteger($countMax, '>', 0, 'Timing.countMax')) {
            $this->values['repeat']['countMax'] = $countMax;
        } else {
            $this->values['hiddenProperties']['repeat']['countMax'] = $countMax;
        }
    }

    public function setDuration(float $duration): void
    {
        $this->values['repeat']['duration'] = $duration;
    }

    public function setDurationMax(float $durationMax): void
    {
        $this->values['repeat']['durationMAx'] = $durationMax;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDurationUnit(string $unit): void
    {
        if ($this->validateInArray($unit, ['s', 'min', 'h', 'd', 'wk', 'mo', 'a'], 'Timing.durationUnit')) {
            $this->values['repeat']['durationUnit'] = $unit;
        } else {
            $this->values['hiddenProperties']['repeat']['durationUnit'] = $unit;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setFrequency(int $frequency): void
    {
        if ($this->validateInteger($frequency, '>', 0, 'Timing.frequency')) {
            $this->values['repeat']['frequency'] = $frequency;
        } else {
            $this->values['hiddenProperties']['repeat']['frequency'] = $frequency;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setFrequencyMax(int $frequency): void
    {
        if ($this->validateInteger($frequency, '>', 0, 'Timing.frequencyMax')) {
            $this->values['repeat']['frequencyMax'] = $frequency;
        } else {
            $this->values['hiddenProperties']['repeat']['frequencyMax'] = $frequency;
        }
    }

    public function setPeriod(float $period): void
    {
        $this->values['repeat']['period'] = $period;
    }

    public function setPeriodMax(float $period): void
    {
        $this->values['repeat']['periodMax'] = $period;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setPeriodUnit(string $unit): void
    {
        if ($this->validateInArray($unit, ['s', 'min', 'h', 'd', 'wk', 'mo', 'a'], 'Timing.periodUnit')) {
            $this->values['repeat']['periodUnit'] = $unit;
        } else {
            $this->values['hiddenProperties']['repeat']['periodUnit'] = $unit;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDayOfWeek(string $day): void
    {
        $this->validateInArray($day, ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']);
        if (
            ! isset($this->values['repeat']['dayOfWeek']) ||
            ! is_array($this->values['repeat']['dayOfWeek'])
        ) {
            $this->values['repeat']['dayOfWeek'] = [];
        }
        $this->values['repeat']['dayOfWeek'][] = $day;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setTimeOfDay(string $dateString): void
    {
        $this->validateTime($dateString);
        if (
            ! isset($this->values['repeat']['time']) ||
            ! is_array($this->values['repeat']['time'])
        ) {
            $this->values['repeat']['time'] = [];
        }
        $this->values['repeat']['time'][] = $dateString;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setWhen(string $code): void
    {
        $this->validateCode($code);
        if (
            ! isset($this->values['repeat']['when']) ||
            ! is_array($this->values['repeat']['when'])
        ) {
            $this->values['repeat']['when'] = [];
        }
        $this->values['repeat']['when'][] = $code;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setOffset(int $offset): void
    {
        if ($this->validateInteger($offset, '>=', 0, 'Timing.offset')) {
            $this->values['repeat']['offset'] = $offset;
        } else {
            $this->values['hiddenProperties']['repeat']['offset'] = $offset;
        }
    }

    public function setCode(CodeableConcept $code): void
    {
        $this->values['code'] = $code;
    }
}
