<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Annotation;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Dosage;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class MedicationStatementResource extends AbstractResource
{
    protected string $name = 'MedicationStatement';

    public const string STATUS_ACTIVE = 'active';

    public const string STATUS_COMPLETED = 'completed';

    public const string STATUS_ENTERED_IN_ERROR = 'entered-in-error';

    public const string STATUS_INTENDED = 'intended';

    public const string STATUS_STOPPED = 'stopped';

    public const string STATUS_ON_HOLD = 'on-hold';

    public const string STATUS_UNKNOWN = 'unknown';

    public const string STATUS_NOT_TAKEN = 'not-taken';

    public const array STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_COMPLETED,
        self::STATUS_ENTERED_IN_ERROR,
        self::STATUS_INTENDED,
        self::STATUS_STOPPED,
        self::STATUS_ON_HOLD,
        self::STATUS_UNKNOWN,
        self::STATUS_NOT_TAKEN,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->setResourceType();
    }

    public function setMeta(Meta $meta): void
    {
        $this->values['meta'] = $meta;
    }

    public function setIdentifier(Identifier $identifier): void
    {
        $this->initArrayProperty('identifier');
        $this->values['identifier'][] = $identifier;
    }

    public function setBasedOn(Reference $basedOn): void
    {
        $this->initArrayProperty('basedOn');
        $this->values['basedOn'][] = $basedOn;
    }

    public function setPartOf(Reference $partOf): void
    {
        $this->initArrayProperty('partOf');
        $this->values['partOf'][] = $partOf;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setStatus(string $status): void
    {
        if ($this->validateInArray($status, self::STATUSES, "$this->name.status")) {
            $this->values['status'] = $status;
        } else {
            $this->values['hiddenProperties']['status'] = $status;
        }
    }

    public function setStatusReason(CodeableConcept $statusReason): void
    {
        $this->initArrayProperty('statusReason');
        $this->values['statusReason'][] = $statusReason;
    }

    public function setCategory(CodeableConcept $category): void
    {
        $this->values['category'] = $category;
    }

    public function setMedicationReference(Reference $medicationReference): void
    {
        $this->values['medicationReference'] = $medicationReference;
    }

    public function setMedicationCodeableConcept(CodeableConcept $medicationCodeableConcept): void
    {
        $this->values['medicationCodeableConcept'] = $medicationCodeableConcept;
    }

    public function setSubject(Reference $subject): void
    {
        $this->values['subject'] = $subject;
    }

    public function setContext(Reference $context): void
    {
        $this->values['context'] = $context;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setEffectiveDateTime(string $effectiveDateTime): void
    {
        if ($this->validateDateTime($effectiveDateTime, "$this->name.effectiveDateTime")) {
            $this->values['effectiveDateTime'] = $effectiveDateTime;
        } else {
            $this->values['hiddenProperties']['effectiveDateTime'] = $effectiveDateTime;
        }
    }

    public function setEffectivePeriod(Period $effectivePeriod): void
    {
        $this->values['effectivePeriod'] = $effectivePeriod;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDateAsserted(string $dateAsserted): void
    {
        if ($this->validateDateTime($dateAsserted, "$this->name.dateAsserted")) {
            $this->values['dateAsserted'] = $dateAsserted;
        } else {
            $this->values['hiddenProperties']['dateAsserted'] = $dateAsserted;
        }
    }

    public function setInformationSource(Reference $informationSource): void
    {
        $this->values['informationSource'] = $informationSource;
    }

    public function setDerivedFrom(Reference $derivedFrom): void
    {
        $this->initArrayProperty('derivedFrom');
        $this->values['derivedFrom'][] = $derivedFrom;
    }

    public function setReasonCode(CodeableConcept $reasonCode): void
    {
        $this->initArrayProperty('reasonCode');
        $this->values['reasonCode'][] = $reasonCode;
    }

    public function setReasonReference(Reference $reasonReference): void
    {
        $this->initArrayProperty('reasonReference');
        $this->values['reasonReference'][] = $reasonReference;
    }

    public function setNote(Annotation $note): void
    {
        $this->initArrayProperty('note');
        $this->values['note'][] = $note;
    }

    public function setDosage(Dosage $dosage): void
    {
        $this->initArrayProperty('dosage');
        $this->values['dosage'][] = $dosage;
    }
}
