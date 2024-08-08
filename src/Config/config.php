<?php

return [
    'functions_to_skip_when_mapping' => [
        'Patient.extension',
        'Patient.modifierExtension',
        'Encounter.extension',
        'Encounter.modifierExtension',
        'Encounter.virtualServiceDetail',
        'Questionnaire.extension',
        'Questionnaire.modifierExtension',
        'Questionnaire.contact.extension',
        'Questionnaire.useContext.extension',
        'QuestionnaireResponse.extension',
        'QuestionnaireResponse.modifierExtension',
    ],

    'ignore_validations' => true,

    'hapi_url' => env('HAPI_URL', null),
];
