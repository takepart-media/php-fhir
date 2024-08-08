<?php

namespace Takepartdev\LaravelFhir\DataTypes\Patient;

use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class PatientLink extends InternalResource
{
    protected string $name = 'PatientLink';

    public const string TYPE_REPLACED_BY = 'replaced-by';

    public const string TYPE_REPLACES = 'replaces';

    public const string TYPE_REFER = 'refer';

    public const string TYPE_SEEALSO = 'seealso';

    public const array PATIENT_LINK_TYPES = [
        self::TYPE_REPLACED_BY,
        self::TYPE_REPLACES,
        self::TYPE_REFER,
        self::TYPE_SEEALSO,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function setOther(Reference $other): void
    {
        $this->values['other'] = $other;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setType(string $code): void
    {
        if ($this->validateInArray($code, self::PATIENT_LINK_TYPES, 'PatientLink.type')) {
            $this->values['type'] = $code;
        } else {
            $this->values['hiddenProperties']['type'] = $code;
        }
    }
}
