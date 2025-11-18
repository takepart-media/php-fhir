<?php

namespace Takepartdev\LaravelFhir\DataTypes\ResearchStudy;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Label extends AbstractResource
{
    protected string $name = 'Label';

    public function __construct()
    {
        parent::__construct();
    }

    public function setType(CodeableConcept $type): void
    {
        $this->values['type'] = $type;
    }

    public function setValue(string $value): void
    {
        $this->values['value'] = $value;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setLanguage(string $language): void
    {
        if ($this->validateLanguage($language, "$this->name.language")) {
            $this->values['language'] = $language;
        } else {
            $this->values['hiddenProperties']['language'] = $language;
        }
    }
}
