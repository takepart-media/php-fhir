<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Period extends AbstractResource
{
    protected string $name = 'Period';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setStart(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, 'Period.start')) {
            $this->values['start'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['start'] = $dateTimeString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setEnd(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, 'Period.end')) {
            $this->values['end'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['end'] = $dateTimeString;
        }
    }
}
