<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Annotation;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\CodeableReference;
use Takepartdev\LaravelFhir\DataTypes\Extension;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Narrative;
use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Quantity;
use Takepartdev\LaravelFhir\DataTypes\Range;
use Takepartdev\LaravelFhir\DataTypes\Ratio;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\DataTypes\ServiceRequest\OrderDetail;
use Takepartdev\LaravelFhir\DataTypes\ServiceRequest\PatientInstruction;
use Takepartdev\LaravelFhir\DataTypes\Timing;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class ServiceRequestResource extends AbstractResource
{
    protected string $name = 'ServiceRequest';

    public const string STATUS_DRAFT = 'draft';

    public const string STATUS_ACTIVE = 'active';

    public const string STATUS_ON_HOLD = 'on-hold';

    public const string STATUS_REVOKED = 'revoked';

    public const string STATUS_COMPLETED = 'completed';

    public const string STATUS_ENTERED_IN_ERROR = 'entered-in-error';

    public const string STATUS_UNKNOWN = 'unknown';

    public const array SERVICE_REQUEST_STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_ACTIVE,
        self::STATUS_ON_HOLD,
        self::STATUS_REVOKED,
        self::STATUS_COMPLETED,
        self::STATUS_ENTERED_IN_ERROR,
        self::STATUS_UNKNOWN,
    ];

    public const string INTENT_PROPOSAL = 'proposal';

    public const string INTENT_PLAN = 'plan';

    public const string INTENT_DIRECTIVE = 'directive';

    public const string INTENT_ORDER = 'order';

    public const array SERVICE_REQUEST_INTENTS = [
        self::INTENT_PROPOSAL,
        self::INTENT_PLAN,
        self::INTENT_DIRECTIVE,
        self::INTENT_ORDER,
    ];

    public const string PRIORITY_ROUTINE = 'routine';

    public const string PRIORITY_URGENT = 'urgent';

    public const string PRIORITY_ASAP = 'asap';

    public const string PRIORITY_STAT = 'stat';

    public const array SERVICE_REQUEST_PRIORITIES = [
        self::PRIORITY_ROUTINE,
        self::PRIORITY_URGENT,
        self::PRIORITY_ASAP,
        self::PRIORITY_STAT,
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
        if ($this->validateLanguage($language, 'ServiceRequest.language')) {
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
    public function setInstantiatesCanonical(string $canonical): void
    {
        if ($this->validateUri($canonical, 'ServiceRequest.instantiatesCanonical')) {
            $this->initArrayProperty('instantiatesCanonical');
            $this->values['instantiatesCanonical'][] = $canonical;
        } else {
            $this->values['hiddenProperties']['instantiatesCanonical'][] = $canonical;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setInstantiatesUri(string $instantiatesUri): void
    {
        if ($this->validateUri($instantiatesUri, 'ServiceRequest.instantiatesUri')) {
            $this->initArrayProperty('instantiatesUri');
            $this->values['instantiatesUri'][] = $instantiatesUri;
        } else {
            $this->values['hiddenProperties']['instantiatesUri'][] = $instantiatesUri;
        }
    }

    public function setBasedOn(Reference $basedOn): void
    {
        $this->initArrayProperty('basedOn');
        $this->values['basedOn'][] = $basedOn;
    }

    public function setReplaces(Reference $replaces): void
    {
        $this->initArrayProperty('replaces');
        $this->values['replaces'][] = $replaces;
    }

    public function setRequisition(Identifier $requisition): void
    {
        $this->values['requisition'] = $requisition;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setStatus(string $code): void
    {
        if ($this->validateInArray($code, self::SERVICE_REQUEST_STATUSES, 'ServiceRequest.status')) {
            $this->values['status'] = $code;
        } else {
            $this->values['hiddenProperties']['status'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setIntent(string $code): void
    {
        if ($this->validateInArray($code, self::SERVICE_REQUEST_INTENTS, 'ServiceRequest.intent')) {
            $this->values['intent'] = $code;
        } else {
            $this->values['hiddenProperties']['intent'] = $code;
        }
    }

    public function setCategory(CodeableConcept $category): void
    {
        $this->initArrayProperty('category');
        $this->values['category'][] = $category;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setPriority(string $code): void
    {
        if ($this->validateInArray($code, self::SERVICE_REQUEST_PRIORITIES, 'ServiceRequest.priority')) {
            $this->values['priority'] = $code;
        } else {
            $this->values['hiddenProperties']['priority'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDoNotPerform($doNotPerform): void
    {
        if ($this->validateBoolean($doNotPerform, 'ServiceRequest.doNotPerform')) {
            $this->values['doNotPerform'] = $doNotPerform;
        } else {
            $this->values['hiddenProperties']['doNotPerform'] = $doNotPerform;
        }
    }

    public function setCode(CodeableConcept $code): void
    {
        $this->values['code'] = $code;
    }

    public function setOrderDetail(OrderDetail $orderDetail): void
    {
        $this->initArrayProperty('orderDetail');
        $this->values['orderDetail'][] = $orderDetail;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setQuantityQuantity(Quantity $quantity): void
    {
        if ($this->validateOneOfThese('quantity', 'ServiceRequest.quantityQuantity')) {
            $this->values['quantityQuantity'] = $quantity;
        } else {
            $this->values['hiddenProperties']['quantityQuantity'] = $quantity;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setQuantityRatio(Ratio $ratio): void
    {
        if ($this->validateOneOfThese('quantity', 'ServiceRequest.quantityRatio')) {
            $this->values['quantityRatio'] = $ratio;
        } else {
            $this->values['hiddenProperties']['quantityRatio'] = $ratio;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setQuantityRange(Range $range): void
    {
        if ($this->validateOneOfThese('quantity', 'ServiceRequest.quantityRange')) {
            $this->values['quantityRange'] = $range;
        } else {
            $this->values['hiddenProperties']['quantityRange'] = $range;
        }
    }

    public function setSubject(Reference $subject): void
    {
        $this->values['subject'] = $subject;
    }

    public function setFocus(Reference $focus): void
    {
        $this->initArrayProperty('focus');
        $this->values['focus'][] = $focus;
    }

    public function setEncounter(Reference $encounter): void
    {
        $this->initArrayProperty('encounter');
        $this->values['encounter'][] = $encounter;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setOccurrenceDateTime(string $dateTimeString): void
    {
        if ($this->validateOneOfThese('occurrence', 'ServiceRequest.occurrence') &&
            $this->validateDateTime($dateTimeString, 'ServiceRequest.occurrenceDateTime')) {
            $this->values['occurrenceDateTime'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['occurrenceDateTime'] = $dateTimeString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setOccurrencePeriod(Period $period): void
    {
        if ($this->validateOneOfThese('occurrence', 'ServiceRequest.occurrencePeriod')) {
            $this->values['occurrencePeriod'] = $period;
        } else {
            $this->values['hiddenProperties']['occurrencePeriod'] = $period;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setOccurrenceTiming(Timing $timing): void
    {
        if ($this->validateOneOfThese('occurrence', 'ServiceRequest.occurrenceTiming')) {
            $this->values['occurrenceTiming'] = $timing;
        } else {
            $this->values['hiddenProperties']['occurrenceTiming'] = $timing;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAsNeededBoolean($boolean): void
    {
        if ($this->validateOneOfThese('asNeeded', 'ServiceRequest.asNeeded') &&
            $this->validateBoolean($boolean, 'ServiceRequest.asNeededBoolean')) {
            $this->values['asNeededBoolean'] = $boolean;
        } else {
            $this->values['hiddenProperties']['asNeededBoolean'] = $boolean;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAsNeededCodeableConcept(CodeableConcept $codeableConcept): void
    {
        if ($this->validateOneOfThese('asNeeded', 'ServiceRequest.asNeeded')) {
            $this->values['asNeededCodeableConcept'] = $codeableConcept;
        } else {
            $this->values['hiddenProperties']['asNeededCodeableConcept'] = $codeableConcept;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setAuthoredOn(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, 'ServiceRequest.authoredOn')) {
            $this->values['authoredOn'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['authoredOn'] = $dateTimeString;
        }
    }

    public function setRequester(Reference $requester): void
    {
        $this->values['requester'] = $requester;
    }

    public function setPerformerType(CodeableConcept $performerType): void
    {
        $this->values['performerType'] = $performerType;
    }

    public function setPerformer(Reference $performer): void
    {
        $this->initArrayProperty('performer');
        $this->values['performer'][] = $performer;
    }

    public function setLocation(CodeableReference $location): void
    {
        $this->initArrayProperty('location');
        $this->values['location'][] = $location;
    }

    public function setReason(CodeableReference $reason): void
    {
        $this->initArrayProperty('reason');
        $this->values['reason'][] = $reason;
    }

    public function setInsurance(Reference $insurance): void
    {
        $this->initArrayProperty('insurance');
        $this->values['insurance'][] = $insurance;
    }

    public function setSupportingInfo(CodeableReference $supportingInfo): void
    {
        $this->initArrayProperty('supportingInfo');
        $this->values['supportingInfo'][] = $supportingInfo;
    }

    public function setSpecimen(Reference $specimen): void
    {
        $this->initArrayProperty('specimen');
        $this->values['specimen'][] = $specimen;
    }

    public function setBodySite(CodeableReference $bodySite): void
    {
        $this->initArrayProperty('bodySite');
        $this->values['bodySite'][] = $bodySite;
    }

    public function setNote(Annotation $note): void
    {
        $this->initArrayProperty('note');
        $this->values['note'][] = $note;
    }

    public function setPatientInstruction(PatientInstruction $instruction): void
    {
        $this->initArrayProperty('patientInstruction');
        $this->values['patientInstruction'][] = $instruction;
    }

    public function setRelevantHistory(Reference $history): void
    {
        $this->initArrayProperty('relevantHistory');
        $this->values['relevantHistory'][] = $history;
    }
}
