<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Address extends AbstractResource
{
    protected string $name = 'Address';

    public const string USE_HOME = 'home';

    public const string USE_WORK = 'work';

    public const string USE_TEMP = 'temp';

    public const string USE_OLD = 'old';

    public const string USE_BILLING = 'billing';

    public const string TYPE_POSTAL = 'postal';

    public const string TYPE_PHYSICAL = 'physical';

    public const string TYPE_BOTH = 'both';

    public const array ADDRESS_USES = [
        self::USE_HOME,
        self::USE_WORK,
        self::USE_TEMP,
        self::USE_OLD,
        self::USE_BILLING,
    ];

    public const array ADDRESS_TYPES = [
        self::TYPE_POSTAL,
        self::TYPE_PHYSICAL,
        self::TYPE_BOTH,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setUse(string $use): void
    {
        if ($this->validateInArray($use, self::ADDRESS_USES, 'Address.use')) {
            $this->values['use'] = $use;
        } else {
            $this->values['hiddenProperties']['use'] = $use;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setType(string $type): void
    {
        if ($this->validateInArray($type, self::ADDRESS_TYPES, 'Address.type')) {
            $this->values['type'] = $type;
        } else {
            $this->values['hiddenProperties']['type'] = $type;
        }
    }

    public function setText(string $text): void
    {
        $this->values['text'] = $text;
    }

    public function setLine(string $line): void
    {
        $this->initArrayProperty('line');
        $this->values['line'][] = $line;
    }

    public function setCity(string $city): void
    {
        $this->values['city'] = $city;
    }

    public function setDistrict(string $district): void
    {
        $this->values['district'] = $district;
    }

    public function setState(string $state): void
    {
        $this->values['state'] = $state;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->values['postalCode'] = $postalCode;
    }

    public function setCountry(string $country): void
    {
        $this->values['country'] = $country;
    }

    public function setPeriod(Period $period): void
    {
        $this->values['period'] = $period;
    }
}
