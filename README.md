## Laravel-FHIR

This package aims to implement all the necessary *FHIR R5* resources that are required by takepart's projects.
These projects at the moment are the following:
- forMe Register
- Meine Daten
- eliPfad (maybe in the future)

## Requirements

| | |
| --- | --- |
| PHP | `^8.4` |
| Laravel | 10, 11, 12 or 13 |
| Guzzle | `^7.2` |

## Installation

This package is **not published on Packagist**, so Composer has to be told where to find it. The repository is public, so no keys, tokens or credentials are needed.

**1. Register the repository** in your application's `composer.json`:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/takepart-media/php-fhir.git"
    }
]
```

**2. Require the package:**

```bash
composer require takepartdev/php-fhir:dev-main
```

Two things to be aware of here:

- **The PHP namespace does not match the package name.** The package is `takepartdev/php-fhir`, but its classes still live under `Takepartdev\LaravelFhir\` — a leftover from the package's original name. Your `use` statements reference `LaravelFhir`, not `PhpFhir`.
- **There are no tagged releases yet**, so you track the default branch with `dev-main`. If Composer rejects the dev constraint because of your application's stability settings, add the following to your root `composer.json`:

```json
"minimum-stability": "dev",
"prefer-stable": true
```

**3. There is no service provider to register.** `FhirProvider` is declared under `extra.laravel.providers`, so Laravel's package auto-discovery loads it for you. (Earlier versions of these instructions asked you to add the provider to the `providers` array in `config/app.php` — that is obsolete, and on Laravel 11+ that array does not exist.)

**4. Publish the config** — optional, only if you need to change a default:

```bash
php artisan vendor:publish --tag=takepart-php-fhir-config
```

This writes `config/fhir.php` into your application:

| Key | Default | Purpose |
| --- | --- | --- |
| `ignore_validations` | `true` | When `true`, validation exceptions are suppressed while building FHIR objects. Be aware this is a silent-failure path: an invalid value is moved to `hiddenProperties`, which `toArray()` omits, so a bad value is dropped rather than raised. Set to `false` to have `FhirValidators` throw instead. |
| `snomed_test_url` | SNOMED training server | Fallback base URL used by the `Snomed` connection when none is passed to its constructor. |

The provider merges its own config, so the package works without publishing anything.

**5. Verify it works.** Nothing needs booting or wiring up — construct a resource anywhere in your app:

```php
use Takepartdev\LaravelFhir\Resources\PatientResource;
use Takepartdev\LaravelFhir\DataTypes\HumanName;

$patient = new PatientResource();
$name = new HumanName();
$name->setFamily('Chalmers');
$patient->setName($name);

$patient->toArray();
```

To talk to a server, instantiate a connection directly — there is no facade and nothing is bound into the container:

```php
use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Connections\Snomed;

$hapi = new Hapi('https://your-hapi-server.test/fhir');
$snomed = new Snomed(null);
```

Passing `null` to `Snomed` falls back to the `fhir.snomed_test_url` config value. See the [HAPI](#hapi) section below for authentication options and the full list of accessors.

## Updating

Because you are tracking a branch rather than a release, `composer update takepartdev/php-fhir` pulls the latest commit from `main`. Pin to a specific commit with `dev-main#<sha>` if you need reproducible builds until releases are tagged.

## Usage

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
