<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class ContactPoint extends AbstractResource
{
    protected string $name = 'ContactPoint';

    public const string SYSTEM_PHONE = 'phone';

    public const string SYSTEM_FAX = 'fax';

    public const string SYSTEM_EMAIL = 'email';

    public const string SYSTEM_PAGER = 'pager';

    public const string SYSTEM_URL = 'url';

    public const string SYSTEM_SMS = 'sms';

    public const string SYSTEM_OTHER = 'other';

    public const string USE_HOME = 'home';

    public const string USE_WORK = 'work';

    public const string USE_TEMP = 'temp';

    public const string USE_OLD = 'old';

    public const string USE_MOBILE = 'mobile';

    public const array CONTACT_POINT_USES = [
        self::USE_HOME,
        self::USE_WORK,
        self::USE_TEMP,
        self::USE_OLD,
        self::USE_MOBILE,
    ];

    public const array CONTACT_POINT_SYSTEMS = [
        self::SYSTEM_PHONE,
        self::SYSTEM_FAX,
        self::SYSTEM_EMAIL,
        self::SYSTEM_PAGER,
        self::SYSTEM_URL,
        self::SYSTEM_SMS,
        self::SYSTEM_OTHER,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setSystem(string $code): void
    {
        if ($this->validateInArray($code, self::CONTACT_POINT_SYSTEMS, 'ContactPoint.system')) {
            $this->values['system'] = $code;
        } else {
            $this->values['hiddenProperties']['system'] = $code;
        }
    }

    public function setValue(string $value): void
    {
        $this->values['value'] = $value;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setUse(string $use): void
    {
        if ($this->validateInArray($use, self::CONTACT_POINT_USES, 'ContactPoint.use')) {
            $this->values['use'] = $use;
        } else {
            $this->values['hiddenProperties']['use'] = $use;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setRank(int $rank): void
    {
        if ($this->validateInteger($rank, '>=', 1, 'ContactPoint.rank')) {
            $this->values['rank'] = $rank;
        } else {
            $this->values['hiddenProperties']['rank'] = $rank;
        }
    }

    public function setPeriod(Period $period): void
    {
        $this->values['period'] = $period;
    }
}
