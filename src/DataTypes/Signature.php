<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Signature extends AbstractResource
{
    protected string $name = 'Signature';

    public function __construct()
    {
        parent::__construct();
    }

    public function setType(Coding $coding): void
    {
        $this->initArrayProperty('type');
        $this->values['type'][] = $coding;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setWhen(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, "$this->name.when")) {
            $this->values['when'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['when'] = null;
        }
    }

    public function setWho(Reference $reference): void
    {
        $this->values['who'] = $reference;
    }

    public function setOnBehalfOf(Reference $reference): void
    {
        $this->values['onBehalfOf'] = $reference;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setTargetFormat(string $code): void
    {
        if ($this->validateCode($code, "$this->name.targetFormat")) {
            $this->values['targetFormat'] = $code;
        } else {
            $this->values['hiddenProperties']['targetFormat'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setSigFormat(string $code): void
    {
        if ($this->validateCode($code, "$this->name.sigFormat")) {
            $this->values['sigFormat'] = $code;
        } else {
            $this->values['hiddenProperties']['sigFormat'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setData(string $data): void
    {
        if ($this->validateBase64($data, "$this->name.data")) {
            $this->values['data'] = $data;
        } else {
            $this->values['hiddenProperties']['data'] = $data;
        }
    }
}
