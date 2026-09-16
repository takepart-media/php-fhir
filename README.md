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
- Condition
- Encounter
- List
- Medication
- MedicationStatement
- Observation
- Organization
- Patient
- Practitioner
- Questionnaire
- QuestionnaireResponse
- ResearchStudy
- ResearchSubject
- ServiceRequest
- Subscription (FHIR R4 + the Subscriptions R5 Backport IG, as required by ISiK Stufe 5 — a deliberate exception to this package's R5 scope, see the `SubscriptionResource` class docblock)

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

The package also has a *HAPI* server connection built in. Every resource listed above **except *ServiceRequest*** can be queried&sent to&from the configured HAPI server, each through its own accessor on the connection:

| Resource | Accessor |
| --- | --- |
| Bundle | `$hapi->bundles` |
| Condition | `$hapi->conditions` |
| Encounter | `$hapi->encounters` |
| List | `$hapi->lists` |
| Medication | `$hapi->medications` |
| MedicationStatement | `$hapi->medicationStatements` |
| Observation | `$hapi->observations` |
| Organization | `$hapi->organizations` |
| Patient | `$hapi->patients` |
| Practitioner | `$hapi->practitioners` |
| Questionnaire | `$hapi->questionnaires` |
| QuestionnaireResponse | `$hapi->questionnaireResponses` |
| ResearchStudy | `$hapi->researchStudies` |
| ResearchSubject | `$hapi->researchSubjects` |
| Subscription | `$hapi->subscriptions` |

There is also `$hapi->serverAction->createBundleTransaction()` for posting a transaction Bundle to the server root.

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
Other implemented functions:
- all()
- retrieve()
- create()
- update()
- destroy()
- validate()

`SubscriptionService` additionally provides `findByUrl()`, which searches on the R4 `url` search parameter (it matches `Subscription.channel.endpoint`). Use it to discover the subscriptions you already registered on a server, so no local subscription-state table is needed:
```php
$subscriptions = $hapi->subscriptions->findByUrl('https://your-app.test/api/fhir/webhook');
```

## Tests

Clone this repository, then:

```bash
composer install
vendor/bin/phpunit
```

The suite hydrates the FHIR JSON fixtures under `tests/fixtures/<resource-type>/` through `FhirObject` and asserts each one serializes back to an identical structure. Tests extend `Takepartdev\LaravelFhir\Tests\TestCase`, which boots a container via `orchestra/testbench` and registers `FhirProvider`.

To cover a new example, drop its JSON into `tests/fixtures/<resource-type>/` — the matching pseudo-test picks up every file in that directory.

Contact [this](mailto:jploens@takepart-media.de) or [that](mailto:kalman.kulcsar@lynxsolutions.eu) guy should you have any questions.
