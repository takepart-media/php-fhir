<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Address;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\ExtendedContactDetail;
use Takepartdev\LaravelFhir\DataTypes\Extension;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Narrative;
use Takepartdev\LaravelFhir\DataTypes\Practitioner\Qualification;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class OrganizationResource extends AbstractResource
{
    protected string $name = 'Organization';

    public function __construct()
    {
        parent::__construct();
        $this->setResourceType();
    }

    //TODO: check the need for this setter as it does not exist in the documentation
    public function setAddress(Address $address): void
    {
        $this->initArrayProperty('address');
        $this->values['address'][] = $address;
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
        if ($this->validateLanguage($language, 'Organization.language')) {
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
        $this->values['extension'] = $extension;
    }

    public function setModifierExtension(Extension $modifierExtension): void
    {
        $this->initArrayProperty('modifierExtension');
        $this->values['modifierExtension'][] = $modifierExtension;
    }

    public function setIdentifier(Identifier $identifier): void
    {
        $this->initArrayProperty('identifier');
        $this->values['identifier'][] = $identifier;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setActive($active): void
    {
        if ($this->validateBoolean($active, "$this->name.active")) {
            $this->values['active'] = $active;
        } else {
            $this->values['hiddenProperties']['active'] = $active;
        }
    }

    public function setType(CodeableConcept $type): void
    {
        $this->initArrayProperty('type');
        $this->values['type'][] = $type;
    }

    public function setName(string $name): void
    {
        $this->values['name'] = $name;
    }

    public function setAlias(string $alias): void
    {
        $this->initArrayProperty('alias');
        $this->values['alias'][] = $alias;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDescription(string $markdown): void
    {
        if ($this->validateMarkdown($markdown, 'Organization.description')) {
            $this->values['description'] = $markdown;
        } else {
            $this->values['hiddenProperties']['description'] = $markdown;
        }
    }

    public function setContact(ExtendedContactDetail $contactDetail): void
    {
        $this->initArrayProperty('contact');
        $this->values['contact'][] = $contactDetail;
    }

    public function setPartOf(Reference $partOf): void
    {
        $this->values['partOf'] = $partOf;
    }

    public function setEndpoint(Reference $endpoint): void
    {
        $this->initArrayProperty('endpoint');
        $this->values['endpoint'][] = $endpoint;
    }

    public function setQualification(Qualification $qualification): void
    {
        $this->initArrayProperty('qualification');
        $this->values['qualification'][] = $qualification;
    }
}
