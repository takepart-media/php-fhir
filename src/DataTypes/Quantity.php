<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Quantity extends AbstractResource
{
    protected string $name = 'Quantity';

    public function __construct()
    {
        parent::__construct();
    }

    public function setValue(float $value): void
    {
        $this->values['value'] = $value;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setComparator(string $comparator): void
    {
        if ($this->validateInArray($comparator, ['<', '<=', '>=', '>', 'ad'], 'Quantity.comparator')) {
            $this->values['comparator'] = $comparator;
        } else {
            $this->values['hiddenProperties']['comparator'] = $comparator;
        }
    }

    public function setUnit(string $unit): void
    {
        $this->values['unit'] = $unit;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setSystem(string $uri): void
    {
        if ($this->validateUri($uri, 'Quantity.system')) {
            $this->values['system'] = $uri;
        } else {
            $this->values['hiddenProperties']['system'] = $uri;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setCode(string $code): void
    {
        if ($this->validateCode($code, 'Quantity.code')) {
            $this->values['code'] = $code;
        } else {
            $this->values['hiddenProperties']['code'] = $code;
        }
    }
}
