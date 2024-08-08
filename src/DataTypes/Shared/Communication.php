<?php

namespace Takepartdev\LaravelFhir\DataTypes\Shared;

use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class Communication extends InternalResource
{
    protected string $name = 'Communication';

    public function __construct()
    {
        parent::__construct();
    }

    public function setLanguage(CodeableConcept $language): void
    {
        $this->initArrayProperty('language');
        $this->values['language'][] = $language;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setPreferred($preferred): void
    {
        if ($this->validateBoolean($preferred, 'Communication.preferred')) {
            $this->values['preferred'] = $preferred;
        } else {
            $this->values['hiddenProperties']['preferred'] = $preferred;
        }
    }
}
