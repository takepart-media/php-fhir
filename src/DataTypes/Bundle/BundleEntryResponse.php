<?php

namespace Takepartdev\LaravelFhir\DataTypes\Bundle;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class BundleEntryResponse extends InternalResource
{
    protected string $name = 'BundleEntryResponse';

    public function __construct()
    {
        parent::__construct();
    }

    public function setStatus(string $status): void
    {
        $this->values['status'] = $status;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setLocation(string $uri): void
    {
        if ($this->validateUri($uri, "$this->name.location")) {
            $this->values['location'] = $uri;
        } else {
            $this->values['hiddenProperties']['location'] = $uri;
        }
    }

    public function setEtag(string $etag): void
    {
        $this->values['etag'] = $etag;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setLastModified(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, "$this->name.lastModified")) {
            $this->values['lastModified'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['lastModified'] = $dateTimeString;
        }
    }

    public function setOutcome(AbstractResource $resource): void
    {
        $this->values['outcome'] = $resource;
    }
}
