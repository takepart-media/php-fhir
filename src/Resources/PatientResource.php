<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Address;
use Takepartdev\LaravelFhir\DataTypes\Attachment;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\ContactPoint;
use Takepartdev\LaravelFhir\DataTypes\Extension;
use Takepartdev\LaravelFhir\DataTypes\HumanName;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Narrative;
use Takepartdev\LaravelFhir\DataTypes\Patient\PatientContact;
use Takepartdev\LaravelFhir\DataTypes\Patient\PatientLink;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\DataTypes\Shared\Communication;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class PatientResource extends AbstractResource
{
    protected string $name = 'Patient';

    public const string GENDER_MALE = 'male';

    public const string GENDER_FEMALE = 'female';

    public const string GENDER_UNKNOWN = 'unknown';

    public const string GENDER_OTHER = 'other';

    //    //TODO: empty gender is non existent in the official fhir docs
    public const string GENDER_EMPTY = '';

    public const array PATIENT_GENDERS = [
        self::GENDER_MALE,
        self::GENDER_FEMALE,
        self::GENDER_UNKNOWN,
        self::GENDER_OTHER,
        self::GENDER_EMPTY,
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
        if ($this->validateLanguage($language, 'Patient.language')) {
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
        if ($this->validateBoolean($active, 'Patient.active')) {
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
        if ($this->validateInArray($gender, self::PATIENT_GENDERS, 'Patient.gender')) {
            $this->values['gender'] = $gender;
        } else {
            $this->values['hiddenProperties']['gender'] = $gender;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setBirthDate(string $birthDateString): void
    {
        if ($this->validateDate($birthDateString, 'Patient.birthDate')) {
            $this->values['birthDate'] = $birthDateString;
        } else {
            $this->values['hiddenProperties']['birthDate'] = $birthDateString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDeceasedBoolean(bool $deceased): void
    {
        if ($this->validateOneOfThese('deceased', 'Patient.deceased')) {
            $this->values['deceasedBoolean'] = $deceased;
        } else {
            $this->values['hiddenProperties']['deceasedBoolean'] = $deceased;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDeceasedDateTime(string $deceasedString): void
    {
        if ($this->validateOneOfThese('deceased', 'Patient.deceased') &&
            $this->validateDateTime($deceasedString, 'Patient.deceasedDateTime')) {
            $this->values['deceasedDateTime'] = $deceasedString;
        } else {
            $this->values['hiddenProperties']['deceasedDateTime'] = $deceasedString;
        }
    }

    public function setAddress(Address $address): void
    {
        $this->initArrayProperty('address');
        $this->values['address'][] = $address;
    }

    public function setMaritalStatus(CodeableConcept $maritalStatus): void
    {
        $this->values['maritalStatus'] = $maritalStatus;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setMultipleBirthBoolean($multipleBirthBoolean): void
    {
        if ($this->validateOneOfThese('multipleBirth', 'Patient.multipleBirth') &&
            $this->validateBoolean($multipleBirthBoolean, 'Patient.multipleBirthBoolean')) {
            $this->values['multipleBirthBoolean'] = $multipleBirthBoolean;
        } else {
            $this->values['hiddenProperties']['multipleBirthBoolean'] = $multipleBirthBoolean;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setMultipleBirthInteger(int $multipleBirthInteger): void
    {
        if ($this->validateOneOfThese('multipleBirth', 'Patient.multipleBirth')) {
            $this->values['multipleBirthInteger'] = $multipleBirthInteger;
        } else {
            $this->values['hiddenProperties']['multipleBirthInteger'] = $multipleBirthInteger;
        }
    }

    public function setPhoto(Attachment $photo): void
    {
        $this->initArrayProperty('photo');
        $this->values['photo'][] = $photo;
    }

    public function setContact(PatientContact $contact): void
    {
        $this->initArrayProperty('contact');
        $this->values['contact'][] = $contact;
    }

    public function setCommunication(Communication $communication): void
    {
        $this->initArrayProperty('communication');
        $this->values['communication'][] = $communication;
    }

    public function setGeneralPractitioner(Reference $practitioner): void
    {
        $this->initArrayProperty('practitioner');
        $this->values['practitioner'][] = $practitioner;
    }

    public function setManagingOrganization(Reference $organization): void
    {
        $this->values['managingOrganization'] = $organization;
    }

    public function setLink(PatientLink $link): void
    {
        $this->initArrayProperty('link');
        $this->values['link'][] = $link;
    }
}
