<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Identifier extends AbstractResource
{
    protected string $name = 'Identifier';

    public const string USE_USUAL = 'usual';

    public const string USE_OFFICIAL = 'official';

    public const string USE_TEMP = 'temp';

    public const string USE_SECONDARY = 'secondary';

    public const string USE_OLD = 'old';

    public const array IDENTIFIER_USES = [
        self::USE_USUAL,
        self::USE_OFFICIAL,
        self::USE_TEMP,
        self::USE_SECONDARY,
        self::USE_OLD,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setUse(string $code): void
    {
        if ($this->validateInArray($code, self::IDENTIFIER_USES, 'Identifier.use')) {
            $this->values['use'] = $code;
        } else {
            $this->values['hiddenProperties']['use'] = $code;
        }
    }

    public function setType(CodeableConcept $type): void
    {
        $this->values['type'] = $type;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setSystem(string $uri): void
    {
        if ($this->validateUri($uri, 'Identifier.system')) {
            $this->values['system'] = $uri;
        } else {
            $this->values['hiddenProperties']['system'] = $uri;
        }
    }

    public function setValue(string $value): void
    {
        $this->values['value'] = $value;
    }

    public function setPeriod(Period $period): void
    {
        $this->values['period'] = $period;
    }

    public function setAssigner(Reference $assigner): void
    {
        $this->values['assigner'] = $assigner;
    }
}
