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
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\DataTypes\ResearchStudy\AssociatedParty;
use Takepartdev\LaravelFhir\DataTypes\ResearchStudy\ComparisonGroup;
use Takepartdev\LaravelFhir\DataTypes\ResearchStudy\Label;
use Takepartdev\LaravelFhir\DataTypes\ResearchStudy\Objective;
use Takepartdev\LaravelFhir\DataTypes\ResearchStudy\ProgressStatus;
use Takepartdev\LaravelFhir\DataTypes\ResearchStudy\Recruitment;
use Takepartdev\LaravelFhir\DataTypes\ResearchStudy\RelatesTo;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class ResearchStudy extends AbstractResource
{
    protected string $name = 'ResearchStudy';

    public const string STATUS_DRAFT = 'draft';

    public const string STATUS_ACTIVE = 'active';

    public const string STATUS_RETIRED = 'retired';

    public const string STATUS_UNKNOWN = 'unknown';

    public const array STATUS_CODES = [
        self::STATUS_DRAFT,
        self::STATUS_ACTIVE,
        self::STATUS_RETIRED,
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

    public function setIdentifier(Identifier $identifier): void
    {
        $this->initArrayProperty('identifier');
        $this->values['identifier'][] = $identifier;
    }

    public function setVersion(string $version): void
    {
        $this->values['version'] = $version;
    }

    public function setName(string $name): void
    {
        $this->values['name'] = $name;
    }

    public function setTitle(string $title): void
    {
        $this->values['title'] = $title;
    }

    public function setLabel(Label $label): void
    {
        $this->initArrayProperty('label');
        $this->values['label'][] = $label;
    }

    public function setProtocol(Reference $planDefinition): void
    {
        $this->initArrayProperty('protocol');
        $this->values['protocol'][] = $planDefinition;
    }

    public function setPartOf(Reference $researchStudy): void
    {
        $this->initArrayProperty('partOf');
        $this->values['partOf'][] = $researchStudy;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setCiteAs(string $citeAs): void
    {
        if ($this->validateMarkdown($citeAs, "$this->name.citeAs")) {
            $this->values['citeAs'] = $citeAs;
        } else {
            $this->values['hiddenProperties']['citeAs'] = $citeAs;
        }
    }

    public function setRelatesTo(RelatesTo $relatesTo): void
    {
        $this->initArrayProperty('relatesTo');
        $this->values['relatesTo'][] = $relatesTo;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDate(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, 'Questionnaire.date')) {
            $this->values['date'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['date'] = $dateTimeString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setStatus(string $code): void
    {
        if ($this->validateInArray($code, self::STATUS_CODES, "$this->name.status")) {
            $this->values['status'] = $code;
        } else {
            $this->values['hiddenProperties']['status'] = $code;
        }
    }

    public function setPrimaryPurposeType(CodeableConcept $primaryPurposeType): void
    {
        $this->values['primaryPurposeType'] = $primaryPurposeType;
    }

    public function setPhase(CodeableConcept $phase): void
    {
        $this->values['phase'] = $phase;
    }

    public function setStudyDesign(CodeableConcept $studyDesign): void
    {
        $this->initArrayProperty('studyDesign');
        $this->values['studyDesign'][] = $studyDesign;
    }

    public function setFocus(CodeableReference $codeableReference): void
    {
        $this->initArrayProperty('focus');
        $this->values['focus'][] = $codeableReference;
    }

    public function setCondition(CodeableConcept $condition): void
    {
        $this->initArrayProperty('condition');
        $this->values['condition'][] = $condition;
    }

    public function setKeyword(CodeableConcept $keyword): void
    {
        $this->initArrayProperty('keyword');
        $this->values['keyword'][] = $keyword;
    }

    public function setRegion(CodeableConcept $region): void
    {
        $this->initArrayProperty('region');
        $this->values['region'][] = $region;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDescriptionSummary(string $markdown): void
    {
        if ($this->validateMarkdown($markdown, "$this->name.descriptionSummary")) {
            $this->values['descriptionSummary'] = $markdown;
        } else {
            $this->values['hiddenProperties']['descriptionSummary'] = $markdown;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDescription(string $markdown): void
    {
        if ($this->validateMarkdown($markdown, "$this->name.description")) {
            $this->values['description'] = $markdown;
        } else {
            $this->values['hiddenProperties']['description'] = $markdown;
        }
    }

    public function setPeriod(Period $period): void
    {
        $this->values['period'] = $period;
    }

    public function setSite(Reference $site): void
    {
        $this->initArrayProperty('site');
        $this->values['site'][] = $site;
    }

    public function setNote(Annotation $note): void
    {
        $this->initArrayProperty('note');
        $this->values['note'][] = $note;
    }

    public function setClassifier(CodeableConcept $classifier): void
    {
        $this->initArrayProperty('classifier');
        $this->values['classifier'][] = $classifier;
    }

    public function setAssociatedParty(AssociatedParty $associatedParty): void
    {
        $this->initArrayProperty('associatedParty');
        $this->values['associatedParty'][] = $associatedParty;
    }

    public function setProgressStatus(ProgressStatus $progressStatus): void
    {
        $this->initArrayProperty('progressStatus');
        $this->values['progressStatus'][] = $progressStatus;
    }

    public function setWhyStopped(CodeableConcept $whyStopped): void
    {
        $this->values['whyStopped'] = $whyStopped;
    }

    public function setRecruitment(Recruitment $recruitment): void
    {
        $this->values['recruitment'] = $recruitment;
    }

    public function setComparisonGroup(ComparisonGroup $comparisonGroup): void
    {
        $this->initArrayProperty('comparisonGroup');
        $this->values['comparisonGroup'][] = $comparisonGroup;
    }

    public function setObjective(Objective $objective): void
    {
        $this->initArrayProperty('objective');
        $this->values['objective'][] = $objective;
    }

    public function setResult(Reference $reference): void
    {
        $this->initArrayProperty('result');
        $this->values['result'][] = $reference;
    }
}
