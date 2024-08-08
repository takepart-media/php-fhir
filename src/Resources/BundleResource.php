<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Bundle\BundleEntry;
use Takepartdev\LaravelFhir\DataTypes\Bundle\BundleLink;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Signature;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class BundleResource extends AbstractResource
{
    protected string $name = 'Bundle';

    public const string TYPE_DOCUMENT = 'document';

    public const string TYPE_MESSAGE = 'message';

    public const string TYPE_TRANSACTION = 'transaction';

    public const string TYPE_TRANSACTION_RESPONSE = 'transaction-response';

    public const string TYPE_BATCH = 'batch';

    public const string TYPE_BATCH_RESPONSE = 'batch-response';

    public const string TYPE_HISTORY = 'history';

    public const string TYPE_SEARCHSET = 'searchset';

    public const string TYPE_COLLECTION = 'collection';

    public const string TYPE_SUBSCRIPTION_NOTIFICATION = 'subscription-notification';

    public const array BUNDLE_TYPES = [
        self::TYPE_DOCUMENT,
        self::TYPE_MESSAGE,
        self::TYPE_TRANSACTION,
        self::TYPE_TRANSACTION_RESPONSE,
        self::TYPE_BATCH,
        self::TYPE_BATCH_RESPONSE,
        self::TYPE_HISTORY,
        self::TYPE_SEARCHSET,
        self::TYPE_COLLECTION,
        self::TYPE_SUBSCRIPTION_NOTIFICATION,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->setResourceType();
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
        if ($this->validateLanguage($language, 'Bundle.language')) {
            $this->values['language'] = $language;
        } else {
            $this->values['hiddenProperties']['language'] = $language;
        }
    }

    public function setIdentifier(Identifier $identifier): void
    {
        $this->values['identifier'] = $identifier;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setType(string $code): void
    {
        if ($this->validateInArray($code, self::BUNDLE_TYPES, 'Bundle.type')) {
            $this->values['type'] = $code;
        } else {
            $this->values['hiddenProperties']['type'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setTimestamp(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, 'Bundle.timestamp')) {
            $this->values['timestamp'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['timestamp'] = $dateTimeString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setTotal(int $total): void
    {
        if ($this->validateInteger($total, '>=', 0, 'Bundle.total')) {
            $this->values['total'] = $total;
        } else {
            $this->values['hiddenProperties']['total'] = $total;
        }
    }

    public function setLink(BundleLink $link): void
    {
        $this->initArrayProperty('link');
        $this->values['link'][] = $link;
    }

    public function setEntry(BundleEntry $entry): void
    {
        $this->initArrayProperty('entry');
        $this->values['entry'][] = $entry;
    }

    public function setSignature(Signature $signature): void
    {
        $this->values['signature'] = $signature;
    }

    public function setIssues(AbstractResource $resource): void
    {
        $this->values['issues'] = $resource;
    }
}
