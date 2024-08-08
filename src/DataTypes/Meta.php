<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Meta extends AbstractResource
{
    protected string $name = 'Meta';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setVersionId(string $id): void
    {
        if ($this->validateRegex($id, "'[A-Za-z0-9\-\.]{1,64}'", "$this->name.versionId")) {
            $this->values['versionId'] = $id;
        } else {
            $this->values['hiddenProperties']['versionId'] = $id;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setLastUpdated(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, "$this->name.lastUpdated")) {
            $this->values['lastUpdated'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['lastUpdated'] = $dateTimeString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setSource(string $uri): void
    {
        if ($this->validateUri($uri, "$this->name.source")) {
            $this->values['source'] = $uri;
        } else {
            $this->values['hiddenProperties']['source'] = $uri;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setProfile(string $canonical): void
    {
        if ($this->validateUri($canonical, "$this->name.profile")) {
            $this->initArrayProperty('profile');
            $this->values['profile'][] = $canonical;
        } else {
            $this->values['hiddenProperties']['profile'] = $canonical;
        }
    }

    public function setSecurity(Coding $security): void
    {
        $this->initArrayProperty('security');
        $this->values['security'][] = $security;
    }

    public function setTag(Coding $tag): void
    {
        $this->initArrayProperty('tag');
        $this->values['tag'][] = $tag;
    }
}
