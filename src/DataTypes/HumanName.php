<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class HumanName extends AbstractResource
{
    protected string $name = 'HumanName';

    public const string USE_USUAL = 'usual';

    public const string USE_OFFICIAL = 'official';

    public const string USE_TEMP = 'temp';

    public const string USE_NICKNAME = 'nickname';

    public const string USE_ANONYMOUS = 'anonymous';

    public const string USE_OLD = 'old';

    public const string USE_MAIDEN = 'maiden';

    public const array HUMAN_NAME_USES = [
        self::USE_USUAL,
        self::USE_OFFICIAL,
        self::USE_TEMP,
        self::USE_NICKNAME,
        self::USE_ANONYMOUS,
        self::USE_OLD,
        self::USE_MAIDEN,
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
        if ($this->validateInArray($code, self::HUMAN_NAME_USES, 'HumanName.use')) {
            $this->values['use'] = $code;
        } else {
            $this->values['hiddenProperties']['use'] = $code;
        }
    }

    public function setText(string $text): void
    {
        $this->values['text'] = $text;
    }

    public function setFamily(string $family): void
    {
        $this->values['family'] = $family;
    }

    public function setGiven(string $given): void
    {
        $this->initArrayProperty('given');
        $this->values['given'][] = $given;
    }

    public function setPrefix(string $prefix): void
    {
        $this->initArrayProperty('prefix');
        $this->values['prefix'][] = $prefix;
    }

    public function setSuffix(string $suffix): void
    {
        $this->initArrayProperty('suffix');
        $this->values['suffix'][] = $suffix;
    }

    public function setPeriod(Period $period): void
    {
        $this->values['period'] = $period;
    }
}
