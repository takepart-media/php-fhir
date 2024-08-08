<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class ValueFilter extends AbstractResource
{
    protected string $name = 'ValueFilter';

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
    public function setComparator(string $comparator): void
    {
        if ($this->validateInArray($comparator, ['eq', 'gt', 'lt', 'ge', 'le', 'sa', 'eb'], 'ValueFilter.comparator')) {
            $this->values['comparator'] = $comparator;
        } else {
            $this->values['hiddenProperties']['comparator'] = $comparator;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueDateTime(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, 'ValueFilter.dateTime')) {
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
