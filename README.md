## Laravel-FHIR

This package aims to implement all the necessary *FHIR R5* resources that are required by takepart's projects.
These projects at the moment are the following:
- forMe Register
- Meine Daten
- eliPfad (maybe in the future)

## Usage

### Installation
Follow these steps to add the package to your project:
- Add this line to the *"require"* object in your *composer.json* file: ```"takepartdev/laravel-fhir": "dev-main"```
- Add this object to the *"repositories"* array (also in your *composer.json* file):
```json
{
    "type": "git",
    "url": "https://bitbucket.org/takepartdev/laravel-fhir.git"
}
```
- run *composer update*
- You will need a bitbucket key & secret in order to install the package. Ask for these from the developers.
- Last but not least, register the *FhirProvider* class to the *providers* array in your *app.php* config file: 
```php
Takepartdev\LaravelFhir\FhirProvider::class
```
### FHIR

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

### HAPI

The package also has a *HAPI* server connection built in. All the upper mentioned resources can be queried&sent to&from the configured HAPI server.

The *connectionUrl* (string) parameter is required. That will be the hapi url of your server. The second parameter, *options* (array), is optional, and supports two keys at the moment:
*basic_auth_username* and *basic_auth_password*. If these are provided, the connection to the hapi server will be established using basic auth.

Example: fetch a patient from hapi:
```php
$connectionUrl = "https://your-hapi-server.test/fhir"
$options = [
    'basic_auth_username' => 'foo',
    'basic_auth_password' => 'bar'
];
$hapi = new Hapi($connectionUrl, $options);
$patient = $hapi->patients->retrieve('123');
```
Other implemented functions: all(), retrieve(), create(), update() and validate()

Contact [this](mailto:jploens@takepart-media.de) or [that](mailto:kalman.kulcsar@lynxsolutions.eu) guy should you have any questions.
