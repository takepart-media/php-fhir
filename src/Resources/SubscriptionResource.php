<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\ContactPoint;
use Takepartdev\LaravelFhir\DataTypes\Extension;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Narrative;
use Takepartdev\LaravelFhir\DataTypes\Subscription\Channel;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

/**
 * FHIR R4 (4.0.1) Subscription plus the HL7 Subscriptions R5 Backport IG, as required by
 * ISiK Stufe 5. This is a deliberate exception to the package's R5 scope: the R5 shape
 * (topic, filterBy, channelType, endpoint, parameter) is intentionally not implemented,
 * and SUBSCRIPTION_STATUSES is the R4 valueset, which has no 'entered-in-error'.
 *
 * Registered in FhirObject::MAIN_RESOURCES under the 'Subscription' resourceType.
 *
 * https://simplifier.net/guide/isik-subscription-stufe-5/Einfuehrung/Artefakte/Datenobjekt_Subscription?version=5.0.0
 */
class SubscriptionResource extends AbstractResource
{
    protected string $name = 'Subscription';

    public const string STATUS_REQUESTED = 'requested';

    public const string STATUS_ACTIVE = 'active';

    public const string STATUS_ERROR = 'error';

    public const string STATUS_OFF = 'off';

    public const array  SUBSCRIPTION_STATUSES = [
        self::STATUS_REQUESTED,
        self::STATUS_ACTIVE,
        self::STATUS_ERROR,
        self::STATUS_OFF,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->setResourceType();
    }

    public function setId(string $id): void
    {
        $this->values['id'] = $id;
    }

    public function setMeta(Meta $meta): void
    {
        $this->values['meta'] = $meta;
    }

    public function setImplicitRules(string $implicitRules): void
    {
        $this->values['implicitRules'] = $implicitRules;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setLanguage(string $language): void
    {
        if ($this->validateLanguage($language, 'Subscription.language')) {
            $this->values['language'] = $language;
        } else {
            $this->values['hiddenProperties']['language'] = $language;
        }
    }

    public function setText(Narrative $text): void
    {
        $this->values['text'] = $text;
    }

    public function setContained(array $contained): void
    {
        $this->initArrayProperty('contained');
        $this->values['contained'][] = $contained;
    }

    public function setExtension(Extension $extension): void
    {
        $this->initArrayProperty('extension');
        $this->values['extension'][] = $extension;
    }

    public function setModifierExtension(Extension $modifierExtension): void
    {
        $this->initArrayProperty('modifierExtension');
        $this->values['modifierExtension'][] = $modifierExtension;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setStatus(string $code): void
    {
        if ($this->validateInArray($code, self::SUBSCRIPTION_STATUSES, 'Subscription.status')) {
            $this->values['status'] = $code;
        } else {
            $this->values['hiddenProperties']['status'] = $code;
        }
    }

    public function setContact(ContactPoint $contact): void
    {
        $this->initArrayProperty('contact');
        $this->values['contact'][] = $contact;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setEnd(string $instantString): void
    {
        if ($this->validateDateTime($instantString, 'Subscription.end')) {
            $this->values['end'] = $instantString;
        } else {
            $this->values['hiddenProperties']['end'] = $instantString;
        }
    }

    public function setReason(string $reason): void
    {
        $this->values['reason'] = $reason;
    }

    public function setCriteria(string $criteria): void
    {
        $this->values['criteria'] = $criteria;
    }

    public function setError(string $error): void
    {
        $this->values['error'] = $error;
    }

    public function setChannel(Channel $channel): void
    {
        $this->values['channel'] = $channel;
    }
}
