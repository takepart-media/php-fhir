## Laravel-FHIR

This package aims to implement all the necessary *FHIR R5* resources that are required by takepart's projects.
These projects at the moment are the following:
- forMe Register
- Meine Daten
- eliPfad (maybe in the future)

### Usage

At the moment only the following main resources are implemented:
- Bundle
- Encounter
- Observation
- Organization
- Patient
- Practitioner
- Questionnaire
- QuestionnaireResponse
- ServiceRequest

Example: create a Patient resource & set a name property:
```php
$patient = new PatientResource();
$name = new HumanName();
$name->setUse(HumanName::USE_OFFICIAL);
$name->setFamily('Chalmers');
$name->setGiven('Peter');
$name->setGiven('James');
$patient->setName($name);
```

The package also has a *HAPI* server connection built in. All the upper mentioned resources can be queried&sent to&from the configured HAPI server.
Example: fetch a patient from hapi:
```php
$hapi = new Hapi();
$patient = $hapi->patients->retrieve('123');
```
Other implemented functions: all(), retrieve(), create(), update() and validate()