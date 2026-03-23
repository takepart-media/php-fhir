<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Timing\Repeat;
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

    public function setRepeat(Repeat $repeat): void
    {
        $this->values['repeat'] = $repeat;
    }

    public function setCode(CodeableConcept $code): void
    {
        $this->values['code'] = $code;
    }
}
