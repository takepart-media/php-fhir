<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class SampledData extends AbstractResource
{
    protected string $name = 'SampledData';

    public function __construct()
    {
        parent::__construct();
    }

    public function setOrigin(Quantity $origin): void
    {
        $this->values['origin'] = $origin;
    }

    public function setInterval(float $interval): void
    {
        $this->values['interval'] = $interval;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setIntervalUnit(string $intervalUnit): void
    {
        if ($this->validateCode($intervalUnit, 'SampledData.intervalUnit')) {
            $this->values['intervalUnit'] = $intervalUnit;
        } else {
            $this->values['hiddenProperties']['intervalUnit'] = $intervalUnit;
        }
    }

    public function setFactor(float $factor): void
    {
        $this->values['factor'] = $factor;
    }

    public function setLowerLimit(float $lowerLimit): void
    {
        $this->values['lowerLimit'] = $lowerLimit;
    }

    public function setUpperLimit(float $upperLimit): void
    {
        $this->values['upperLimit'] = $upperLimit;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDimensions(int $dimensions): void
    {
        $this->validateInteger($dimensions, '>', 0);
        $this->values['dimensions'] = $dimensions;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setCodeMap(string $canonical): void
    {
        $this->validateUri($canonical);
        $this->values['codeMap'] = $canonical;
    }

    public function setOffsets(string $offsets): void
    {
        $this->values['offsets'] = $offsets;
    }

    public function setData(string $data): void
    {
        $this->values['data'] = $data;
    }
}
