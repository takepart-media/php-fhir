<?php

namespace Takepartdev\LaravelFhir\DataTypes\Bundle;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class BundleEntry extends InternalResource
{
    protected string $name = 'BundleEntry';

    public function __construct()
    {
        parent::__construct();
    }

    public function setLink(BundleLink $link): void
    {
        $this->initArrayProperty('link');
        $this->values['link'] = $link;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setFullUrl(string $uri): void
    {
        if ($this->validateUri($uri, "$this->name.fullUrl")) {
            $this->values['fullUrl'] = $uri;
        } else {
            $this->values['hiddenProperties']['fullUrl'] = $uri;
        }
    }

    public function setResource(AbstractResource $resource): void
    {
        $this->values['resource'] = $resource;
    }

    public function setSearch(BundleEntrySearch $search): void
    {
        $this->values['search'] = $search;
    }

    public function setRequest(BundleEntryRequest $request): void
    {
        $this->values['request'] = $request;
    }

    public function setResponse(BundleEntryResponse $response): void
    {
        $this->values['response'] = $response;
    }
}
