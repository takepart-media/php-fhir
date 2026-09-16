<?php

namespace Takepartdev\LaravelFhir\DataTypes\Subscription;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Extension;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Channel extends AbstractResource
{
    protected string $name = 'Channel';

    public const string TYPE_REST_HOOK = 'rest-hook';

    public const string TYPE_WEBSOCKET = 'websocket';

    public const string TYPE_EMAIL = 'email';

    public const string TYPE_SMS = 'sms';

    public const string TYPE_MESSAGE = 'message';

    public const array SUBSCRIPTION_CHANNEL_TYPES = [
        self::TYPE_REST_HOOK,
        self::TYPE_WEBSOCKET,
        self::TYPE_EMAIL,
        self::TYPE_SMS,
        self::TYPE_MESSAGE,
    ];

    public function __construct()
    {
        parent::__construct();
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
    public function setType(string $code): void
    {
        if ($this->validateInArray($code, self::SUBSCRIPTION_CHANNEL_TYPES, 'Subscription.channel.type')) {
            $this->values['type'] = $code;
        } else {
            $this->values['hiddenProperties']['type'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setEndpoint(string $endpoint): void
    {
        if ($this->validateUrl($endpoint, 'Subscription.channel.endpoint')) {
            $this->values['endpoint'] = $endpoint;
        } else {
            $this->values['hiddenProperties']['endpoint'] = $endpoint;
        }
    }

    public function setPayload(string $payload): void
    {
        $this->values['payload'] = $payload;
    }

    public function setHeader(string $header): void
    {
        $this->initArrayProperty('header');
        $this->values['header'][] = $header;
    }
}
