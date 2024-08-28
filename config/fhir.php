<?php

return [
    // Used in the FhirValidator class. When set to true, all the validations are ignored when creating a fhir object
    'ignore_validations' => true,

    // Hapi url used to communicate with the hapi server. Other security related variables might be added in the future
    'hapi_url' => env('HAPI_URL', 'http://localhost'),
];
