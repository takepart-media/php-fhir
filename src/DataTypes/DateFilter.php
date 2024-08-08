<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class DateFilter extends AbstractResource
{
    protected string $name = 'DateFilter';

    public function __construct()
    {
        parent::__construct();
    }

    public function setPath(string $path): void
    {
        $this->values['path'] = $path;
    }

    public function setSearchParam(string $param): void
    {
        $this->values['searchParam'] = $param;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueDateTime(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, 'DateFilter.valueDateTime')) {
            $this->values['valueDateTime'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['valueDateTime'] = $dateTimeString;
        }
    }

    public function setValuePeriod(Period $period): void
    {
        $this->values['valuePeriod'] = $period;
    }

    public function setValueDuration($duration): void
    {
        $this->values['valueDuration'] = $duration;
    }
}
