<?php

namespace Takepartdev\LaravelFhir\DataTypes\Bundle;

use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\InternalResource;

class BundleEntryRequest extends InternalResource
{
    protected string $name = 'BundleEntryRequest';

    public const string METHOD_GET = 'GET';

    public const string METHOD_HEAD = 'HEAD';

    public const string METHOD_POST = 'POST';

    public const string METHOD_PUT = 'PUT';

    public const string METHOD_DELETE = 'DELETE';

    public const string METHOD_PATCH = 'PATCH';

    public const array REQUEST_METHODS = [
        self::METHOD_GET,
        self::METHOD_HEAD,
        self::METHOD_POST,
        self::METHOD_PUT,
        self::METHOD_DELETE,
        self::METHOD_PATCH,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setMethod(string $code): void
    {
        if ($this->validateInArray($code, self::REQUEST_METHODS, "$this->name.method")) {
            $this->values['method'] = $code;
        } else {
            $this->values['hiddenProperties']['method'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setUrl(string $uri): void
    {
        if ($this->validateUri($uri, "$this->name.url")) {
            $this->values['url'] = $uri;
        } else {
            $this->values['hiddenProperties']['url'] = $uri;
        }
    }

    public function setIfNoneMatch(string $ifNoneMatch): void
    {
        $this->values['ifNoneMatch'] = $ifNoneMatch;
    }

    public function ifModifiedSince(string $ifModifiedSince): void
    {
        $this->values['ifModifiedSince'] = $ifModifiedSince;
    }

    public function setIfMatch(string $ifMatch): void
    {
        $this->values['ifMatch'] = $ifMatch;
    }

    public function setIfNoneExist(string $ifNoneExist): void
    {
        $this->values['ifNoneExist'] = $ifNoneExist;
    }
}
