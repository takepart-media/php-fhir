<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Address;
use Takepartdev\LaravelFhir\DataTypes\Attachment;
use Takepartdev\LaravelFhir\DataTypes\ContactPoint;
use Takepartdev\LaravelFhir\DataTypes\Extension;
use Takepartdev\LaravelFhir\DataTypes\HumanName;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Narrative;
use Takepartdev\LaravelFhir\DataTypes\Practitioner\Qualification;
use Takepartdev\LaravelFhir\DataTypes\Shared\Communication;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class PractitionerResource extends AbstractResource
{
    protected string $name = 'Practitioner';

    public const string GENDER_MALE = 'male';

    public const string GENDER_FEMALE = 'female';

    public const string GENDER_UNKNOWN = 'unknown';

    public const string GENDER_OTHER = 'other';

    public const array PATIENT_GENDERS = [
        self::GENDER_MALE,
        self::GENDER_FEMALE,
        self::GENDER_UNKNOWN,
        self::GENDER_OTHER,
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
        $this->validateLanguage($language, 'Practitioner.language');
        $this->values['language'] = $language;
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

    public function setName(HumanName $humanName): void
    {
        $this->initArrayProperty('name');
        $this->values['name'][] = $humanName;
    }

    public function setTelecom(ContactPoint $telecom): void
    {
        $this->initArrayProperty('telecom');
        $this->values['telecom'][] = $telecom;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setGender(string $gender): void
    {
        if ($this->validateInArray($gender, self::PATIENT_GENDERS, 'Practitioner.gender')) {
            $this->values['gender'] = $gender;
        } else {
            $this->values['hiddenProperties']['gender'] = $gender;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setBirthDate(string $dateString): void
    {
        if ($this->validateDate($dateString, 'Practitioner.birthDate')) {
            $this->values['birthDate'] = $dateString;
        } else {
            $this->values['hiddenProperties']['birthDate'] = $dateString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDeceasedBoolean($deceased): void
    {
        if ($this->validateOneOfThese('deceased', 'Practitioner.deceased') &&
            $this->validateBoolean($deceased, 'Practitioner.deceasedBoolean')) {
            $this->values['deceasedBoolean'] = $deceased;
        } else {
            $this->values['hiddenProperties']['deceasedBoolean'] = $deceased;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDeceasedDateTime(string $dateTimeString): void
    {
        if ($this->validateOneOfThese('deceased', 'Practitioner.deceased') &&
            $this->validateDateTime($dateTimeString, 'Practitioner.deceasedDateTime')) {
            $this->values['deceasedDateTime'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['deceasedDateTime'] = $dateTimeString;
        }
    }

    public function setAddress(Address $address): void
    {
        $this->initArrayProperty('address');
        $this->values['address'][] = $address;
    }

    public function setPhoto(Attachment $photo): void
    {
        $this->initArrayProperty('photo');
        $this->values['photo'][] = $photo;
    }

    public function setQualification(Qualification $qualification): void
    {
        $this->initArrayProperty('qualification');
        $this->values['qualification'][] = $qualification;
    }

    public function setCommunication(Communication $communication): void
    {
        $this->initArrayProperty('communication');
        $this->values['communication'][] = $communication;
    }
}
