<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\CodeableReference;
use Takepartdev\LaravelFhir\DataTypes\Encounter\EncounterAdmission;
use Takepartdev\LaravelFhir\DataTypes\Encounter\EncounterDiagnosis;
use Takepartdev\LaravelFhir\DataTypes\Encounter\EncounterLocation;
use Takepartdev\LaravelFhir\DataTypes\Encounter\EncounterParticipant;
use Takepartdev\LaravelFhir\DataTypes\Encounter\EncounterReason;
use Takepartdev\LaravelFhir\DataTypes\Extension;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Narrative;
use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\DataTypes\VirtualServiceDetail;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class EncounterResource extends AbstractResource
{
    protected string $name = 'Encounter';

    public const string STATUS_PLANNED = 'planned';

    public const string STATUS_IN_PROGRESS = 'in-progress';

    public const string STATUS_ON_HOLD = 'on-hold';

    public const string STATUS_DISCHARGED = 'discharged';

    public const string STATUS_COMPLETED = 'completed';

    public const string STATUS_CANCELLED = 'cancelled';

    public const string STATUS_DISCONTINUED = 'discontinued';

    public const string STATUS_ENTERED_IN_ERROR = 'entered-in-error';

    public const string STATUS_UNKNOWN = 'unknown';

    public const array ENCOUNTER_STATUSES = [
        self::STATUS_PLANNED,
        self::STATUS_IN_PROGRESS,
        self::STATUS_ON_HOLD,
        self::STATUS_DISCHARGED,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED,
        self::STATUS_DISCONTINUED,
        self::STATUS_ENTERED_IN_ERROR,
        self::STATUS_UNKNOWN,
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
        if ($this->validateLanguage($language, "$this->name.language")) {
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
    public function setStatus(string $status): void
    {
        if ($this->validateInArray($status, self::ENCOUNTER_STATUSES, "$this->name.status")) {
            $this->values['status'] = $status;
        } else {
            $this->values['hiddenProperties']['status'] = $status;
        }
    }

    public function setClass(CodeableConcept $class): void
    {
        $this->initArrayProperty('class');
        $this->values['class'][] = $class;
    }

    public function setPriority(CodeableConcept $priority): void
    {
        $this->values['priority'] = $priority;
    }

    public function setType(CodeableConcept $type): void
    {
        $this->initArrayProperty('type');
        $this->values['type'][] = $type;
    }

    public function setServiceType(CodeableReference $serviceType): void
    {
        $this->values['serviceType'] = $serviceType;
    }

    public function setSubject(Reference $subject): void
    {
        $this->values['subject'] = $subject;
    }

    public function setSubjectStatus(CodeableConcept $subjectStatus): void
    {
        $this->values['subjectStatus'] = $subjectStatus;
    }

    public function setEpisodeOfCare(Reference $episodeOfCare): void
    {
        $this->initArrayProperty('episodeOfCare');
        $this->values['episodeOfCare'][] = $episodeOfCare;
    }

    public function setBasedOn(Reference $reference): void
    {
        $this->initArrayProperty('basedOn');
        $this->values['basedOn'][] = $reference;
    }

    public function setCareTeam(Reference $reference): void
    {
        $this->initArrayProperty('careTeam');
        $this->values['careTeam'][] = $reference;
    }

    public function setPartOf(Reference $partOf): void
    {
        $this->values['partOf'] = $partOf;
    }

    public function setServiceProvider(Reference $serviceProvider): void
    {
        $this->values['serviceProvider'] = $serviceProvider;
    }

    public function setParticipant(EncounterParticipant $participant): void
    {
        $this->initArrayProperty('participant');
        $this->values['participant'][] = $participant;
    }

    public function setAppointment(Reference $appointment): void
    {
        $this->initArrayProperty('appointment');
        $this->values['appointment'][] = $appointment;
    }

    public function setVirtualServiceDetail(VirtualServiceDetail $virtualServiceDetail): void
    {
        $this->initArrayProperty('virtualServiceDetail');
        $this->values['virtualServiceDetail'][] = $virtualServiceDetail;
    }

    public function setActualPeriod(Period $period): void
    {
        $this->values['actualPeriod'] = $period;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setPlannedStartDate(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, "$this->name.plannedStartDate")) {
            $this->values['plannedStartDate'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['plannedStartDate'] = $dateTimeString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setPlannedEndDate(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, "$this->name.plannedEndDate")) {
            $this->values['plannedEndDate'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['plannedEndDate'] = $dateTimeString;
        }
    }

    public function setLength($duration): void
    {
        $this->values['length'] = $duration;
    }

    public function setReason(EncounterReason $reason): void
    {
        $this->initArrayProperty('reason');
        $this->values['reason'][] = $reason;
    }

    public function setDiagnosis(EncounterDiagnosis $diagnosis): void
    {
        $this->initArrayProperty('diagnosis');
        $this->values['diagnosis'][] = $diagnosis;
    }

    public function setAccount(Reference $account): void
    {
        $this->initArrayProperty('account');
        $this->values['account'][] = $account;
    }

    public function setDietPreference(CodeableConcept $dietPreference): void
    {
        $this->initArrayProperty('dietPreference');
        $this->values['dietPreference'][] = $dietPreference;
    }

    public function setSpecialArrangement(CodeableConcept $specialArrangement): void
    {
        $this->initArrayProperty('specialArrangement');
        $this->values['specialArrangement'][] = $specialArrangement;
    }

    public function setSpecialCourtesy(CodeableConcept $specialCourtesy): void
    {
        $this->initArrayProperty('specialCourtesy');
        $this->values['specialCourtesy'][] = $specialCourtesy;
    }

    public function setAdmission(EncounterAdmission $admission): void
    {
        $this->values['admission'] = $admission;
    }

    public function setLocation(EncounterLocation $location): void
    {
        $this->initArrayProperty('location');
        $this->values['location'][] = $location;
    }
}
