<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Sort extends AbstractResource
{
    protected string $name = 'Sort';

    public function __construct()
    {
        parent::__construct();
    }

    public function setPath(string $path): void
    {
        $this->values['path'] = $path;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDirection(string $direction): void
    {
        if ($this->validateCode($direction, 'Sort.direction')) {
            $this->values['direction'] = $direction;
        } else {
            $this->values['hiddenProperties']['direction'] = $direction;
        }
    }
}
