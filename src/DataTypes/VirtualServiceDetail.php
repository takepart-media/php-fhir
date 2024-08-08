<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class VirtualServiceDetail extends AbstractResource
{
    protected string $name = 'VirtualServiceDetail';

    public function __construct()
    {
        parent::__construct();
    }

    public function setExtension(Extension $extension): void
    {
        $this->values['extension'] = $extension;
    }

    public function setChannelType(Coding $channelType): void
    {
        $this->values['channelType'] = $channelType;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAddressUrl(string $url): void
    {
        if ($this->validateUrl($url, "$this->name.addressUrl")) {
            $this->values['addressUrl'] = $url;
        } else {
            $this->values['hiddenProperties']['addressUrl'] = $url;
        }
    }

    public function setAddressString(string $addressString): void
    {
        $this->values['addressString'] = $addressString;
    }

    public function setAddressContactPoint(ContactPoint $cPoint): void
    {
        $this->values['addressContactPoint'] = $cPoint;
    }

    public function setAddressExtendedContactDetail(ExtendedContactDetail $cDetail): void
    {
        $this->values['addressExtendedContactDetail'] = $cDetail;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAdditionalInfo(string $url): void
    {
        if ($this->validateUrl($url, "$this->name.additionalInfo")) {
            $this->initArrayProperty('additionalInfo');
            $this->values['additionalInfo'][] = $url;
        } else {
            $this->values['hiddenProperties']['additionalInfo'][] = $url;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setMaxParticipants(int $participants): void
    {
        if ($this->validateInteger($participants, '>', 0, "$this->name.maxParticipants")) {
            $this->values['maxParticipants'] = $participants;
        } else {
            $this->values['hiddenProperties']['maxParticipants'] = $participants;
        }
    }

    public function setSessionKey(string $key): void
    {
        $this->values['sessionKey'] = $key;
    }
}
