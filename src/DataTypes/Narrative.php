<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Narrative extends AbstractResource
{
    protected string $name = 'Narrative';

    public const string STATUS_GENERATED = 'generated';

    public const string STATUS_EXTENSIONS = 'extensions';

    public const string STATUS_ADDITIONAL = 'additional';

    public const string STATUS_EMPTY = 'empty';

    public const array STATUS_TYPES = [
        self::STATUS_GENERATED,
        self::STATUS_EXTENSIONS,
        self::STATUS_ADDITIONAL,
        self::STATUS_EMPTY,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setStatus(string $code): void
    {
        if ($this->validateInArray($code, self::STATUS_TYPES, "$this->name.status")) {
            $this->values['status'] = $code;
        } else {
            $this->values['hiddenProperties']['status'] = $code;
        }
    }

    public function setDiv(string $html): void
    {
        $this->values['div'] = $html;
    }
}
