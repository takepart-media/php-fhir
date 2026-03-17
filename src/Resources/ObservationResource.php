<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Annotation;
use Takepartdev\LaravelFhir\DataTypes\Attachment;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Extension;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Narrative;
use Takepartdev\LaravelFhir\DataTypes\Observation\Component;
use Takepartdev\LaravelFhir\DataTypes\Observation\ReferenceRange;
use Takepartdev\LaravelFhir\DataTypes\Observation\TriggeredBy;
use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Quantity;
use Takepartdev\LaravelFhir\DataTypes\Range;
use Takepartdev\LaravelFhir\DataTypes\Ratio;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\DataTypes\SampledData;
use Takepartdev\LaravelFhir\DataTypes\Timing;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class ObservationResource extends AbstractResource
{
    protected string $name = 'Observation';

    public const string OBSERVATION_STATUS_REGISTERED = 'registered';

    public const string OBSERVATION_STATUS_PRELIMINARY = 'preliminary';

    public const string OBSERVATION_STATUS_FINAL = 'final';

    public const string OBSERVATION_STATUS_AMENDED = 'amended';

    public const string OBSERVATION_STATUS_CORRECTED = 'corrected';

    public const string OBSERVATION_STATUS_CANCELLED = 'cancelled';

    public const string OBSERVATION_STATUS_ENTERED_IN_ERROR = 'entered-in-error';

    public const string OBSERVATION_STATUS_UNKNOWN = 'unknown';

    public const array OBSERVATION_STATUSES = [
        self::OBSERVATION_STATUS_REGISTERED,
        self::OBSERVATION_STATUS_PRELIMINARY,
        self::OBSERVATION_STATUS_FINAL,
        self::OBSERVATION_STATUS_AMENDED,
        self::OBSERVATION_STATUS_CORRECTED,
        self::OBSERVATION_STATUS_CANCELLED,
        self::OBSERVATION_STATUS_ENTERED_IN_ERROR,
        self::OBSERVATION_STATUS_UNKNOWN,
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
    public function setInstantiatesCanonical(string $instantiatesCanonical): void
    {
        if ($this->validateUri($instantiatesCanonical, "$this->name.instantiatesCanonical")) {
            $this->values['instantiatesCanonical'] = $instantiatesCanonical;
        } else {
            $this->values['hiddenProperties']['instantiatesCanonical'] = $instantiatesCanonical;
        }
    }

    public function setInstantiatesReference(Reference $instantiatesReference): void
    {
        $this->values['instantiatesReference'] = $instantiatesReference;
    }

    public function setBasedOn(Reference $basedOn): void
    {
        $this->values['basedOn'] = $basedOn;
    }

    public function setTriggeredBy(TriggeredBy $triggeredBy): void
    {
        $this->initArrayProperty('triggeredBy');
        $this->values['triggeredBy'][] = $triggeredBy;
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
        if ($this->validateInArray($status, self::OBSERVATION_STATUSES, "$this->name.status")) {
            $this->values['status'] = $status;
        } else {
            $this->values['hiddenProperties']['status'] = $status;
        }
    }

    public function setCategory(CodeableConcept $category): void
    {
        $this->initArrayProperty('category');
        $this->values['category'][] = $category;
    }

    public function setCode(CodeableConcept $code): void
    {
        $this->values['code'] = $code;
    }

    public function setSubject(Reference $subject): void
    {
        $this->values['subject'] = $subject;
    }

    public function setFocus(Reference $focus): void
    {
        $this->values['focus'] = $focus;
    }

    public function setEncounter(Reference $encounter): void
    {
        $this->values['encounter'] = $encounter;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setEffectiveDateTime(string $dateTime): void
    {
        if ($this->validateDateTime($dateTime, "$this->name.effectiveDateTime")) {
            $this->values['effectiveDateTime'] = $dateTime;
        } else {
            $this->values['hiddenProperties']['effectiveDateTime'] = $dateTime;
        }
    }

    public function setEffectivePeriod(Period $period): void
    {
        $this->values['effectivePeriod'] = $period;
    }

    public function setEffectiveTiming(Timing $timing): void
    {
        $this->values['effectiveTiming'] = $timing;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setEffectiveInstant(string $instant): void
    {
        if ($this->validateDateTime($instant, "$this->name.effectiveInstant")) {
            $this->values['effectiveInstant'] = $instant;
        } else {
            $this->values['hiddenProperties']['effectiveInstant'] = $instant;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setIssued(string $issued): void
    {
        if ($this->validateDateTime($issued, "$this->name.issued")) {
            $this->values['issued'] = $issued;
        } else {
            $this->values['hiddenProperties']['issued'] = $issued;
        }
    }

    public function setPerformer(Reference $performer): void
    {
        $this->initArrayProperty('performer');
        $this->values['performer'][] = $performer;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueQuantity(Quantity $valueQuantity): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueQuantity")) {
            $this->values['valueQuantity'] = $valueQuantity;
        } else {
            $this->values['hiddenProperties']['valueQuantity'] = $valueQuantity;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueCodeableConcept(CodeableConcept $codeableConcept): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueCodeableConcept")) {
            $this->values['valueCodeableConcept'] = $codeableConcept;
        } else {
            $this->values['hiddenProperties']['valueCodeableConcept'] = $codeableConcept;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueString(string $valueString): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueString")) {
            $this->values['valueString'] = $valueString;
        } else {
            $this->values['hiddenProperties']['valueString'] = $valueString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueBoolean($valueBoolean): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueBoolean") &&
            $this->validateBoolean($valueBoolean)) {
            $this->values['valueBoolean'] = $valueBoolean;
        } else {
            $this->values['hiddenProperties']['valueBoolean'] = $valueBoolean;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueInteger(int $valueInteger): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueInteger")) {
            $this->values['valueInteger'] = $valueInteger;
        } else {
            $this->values['hiddenProperties']['valueInteger'] = $valueInteger;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueRange(Range $valueRange): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueRange")) {
            $this->values['valueRange'] = $valueRange;
        } else {
            $this->values['hiddenProperties']['valueRange'] = $valueRange;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueRatio(Ratio $valueRatio): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueRatio")) {
            $this->values['valueRatio'] = $valueRatio;
        } else {
            $this->values['hiddenProperties']['valueRatio'] = $valueRatio;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueSampledData(SampledData $valueSampledData): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueSampledData")) {
            $this->values['valueSampledData'] = $valueSampledData;
        } else {
            $this->values['hiddenProperties']['valueSampledData'] = $valueSampledData;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueTime(string $valueTime): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueTime") &&
            $this->validateTime($valueTime, "$this->name.valueTime")) {
            $this->values['valueTime'] = $valueTime;
        } else {
            $this->values['hiddenProperties']['valueTime'] = $valueTime;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueDateTime(string $valueDateTime): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueDateTime") &&
            $this->validateDateTime($valueDateTime, "$this->name.valueDateTime")) {
            $this->values['valueDateTime'] = $valueDateTime;
        } else {
            $this->values['hiddenProperties']['valueDateTime'] = $valueDateTime;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValuePeriod(Period $valuePeriod): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valuePeriod")) {
            $this->values['valuePeriod'] = $valuePeriod;
        } else {
            $this->values['hiddenProperties']['valuePeriod'] = $valuePeriod;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueAttachment(Attachment $valueAttachment): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueAttachment")) {
            $this->values['valueAttachment'] = $valueAttachment;
        } else {
            $this->values['hiddenProperties']['valueAttachment'] = $valueAttachment;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueReference(Reference $valueReference): void
    {
        if ($this->validateOneOfThese('value', "$this->name.valueReference")) {
            $this->values['valueReference'] = $valueReference;
        } else {
            $this->values['hiddenProperties']['valueReference'] = $valueReference;
        }
    }

    public function setDataAbsentReason(CodeableConcept $dataAbsentReason): void
    {
        $this->values['dataAbsentReason'] = $dataAbsentReason;
    }

    public function setInterpretation(CodeableConcept $interpretation): void
    {
        $this->initArrayProperty('interpretation');
        $this->values['interpretation'][] = $interpretation;
    }

    public function setNote(Annotation $note): void
    {
        $this->initArrayProperty('note');
        $this->values['note'][] = $note;
    }

    public function setBodySite(CodeableConcept $bodySite): void
    {
        $this->values['bodySite'] = $bodySite;
    }

    public function setBodyStructure(Reference $bodyStructure): void
    {
        $this->values['bodyStructure'] = $bodyStructure;
    }

    public function setMethod(CodeableConcept $method): void
    {
        $this->values['method'] = $method;
    }

    public function setSpecimen(Reference $specimen): void
    {
        $this->values['specimen'] = $specimen;
    }

    public function setDevice(Reference $device): void
    {
        $this->values['device'] = $device;
    }

    public function setReferenceRange(ReferenceRange $referenceRange): void
    {
        $this->initArrayProperty('referenceRange');
        $this->values['referenceRange'][] = $referenceRange;
    }

    public function setHasMember(Reference $hasMember): void
    {
        $this->initArrayProperty('hasMember');
        $this->values['hasMember'][] = $hasMember;
    }

    public function setDerivedFrom(Reference $derivedFrom): void
    {
        $this->initArrayProperty('derivedFrom');
        $this->values['derivedFrom'][] = $derivedFrom;
    }

    public function setComponent(Component $component): void
    {
        $this->initArrayProperty('component');
        $this->values['component'][] = $component;
    }
}
