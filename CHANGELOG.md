<!--- BEGIN HEADER -->
# Changelog

All notable changes to this project will be documented in this file.
<!--- END HEADER -->

<a name="unreleased"></a>
## [Unreleased]


<a name="3.0.1"></a>
## [3.0.1] - 2025-02-23
### Build
- **config:** Update branch alias to 3.x-dev

### Performance Improvements
- **Response:** Refactor response methods for type clarity
- **dependencies:** Add PHPStan extensions and improve type hints
- **rector:** Remove Deprecated ReturnTypeWillChange Annotations


<a name="3.0.0"></a>
## [3.0.0] - 2025-02-23
### CI
- apply rector
- apply rector
- apply php-cs-fixer
- **config:** Update infection command and json configuration
- **dependencies:** Remove unused packages and add new ones
- **editorconfig:** Update indentation settings
- **rector:** Refactor autoload function handling in configuration

### Code Refactoring
- Add rector configuration file
- Move cache and build files to .build directory
- **support:** Improve function availability checks

### Features
- **auth:** Mark sensitive parameters in constructors
- **dependencies:** Update composer Git hooks and illuminate versions
- **workflows:** upgrade PHP version to 8.0

### Tests
- **composer:** Add phpunit-slow-test-detector dependency
- **config:** Update PHPUnit configuration and dependencies
- **rector:** Replace usage of Pest Faker functions


<a name="2.14.1"></a>
## [2.14.1] - 2025-02-22
### CI
- **composer-updater:** Add additional options to process command
- **github:** Update PHP version in workflows and composer
- **scope:** Update composer.json and add ractor-php82

### Pull Requests
- Merge pull request [#147](https://github.com/guanguans/notify/issues/147) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.12
- Merge pull request [#146](https://github.com/guanguans/notify/issues/146) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.11
- Merge pull request [#145](https://github.com/guanguans/notify/issues/145) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.9
- Merge pull request [#144](https://github.com/guanguans/notify/issues/144) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.8
- Merge pull request [#143](https://github.com/guanguans/notify/issues/143) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.7
- Merge pull request [#142](https://github.com/guanguans/notify/issues/142) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.6
- Merge pull request [#141](https://github.com/guanguans/notify/issues/141) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.5
- Merge pull request [#140](https://github.com/guanguans/notify/issues/140) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.4
- Merge pull request [#139](https://github.com/guanguans/notify/issues/139) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.3
- Merge pull request [#138](https://github.com/guanguans/notify/issues/138) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.3.0


<a name="2.14.0"></a>
## [2.14.0] - 2025-01-13
### Features
- **Authenticators:** Add `reversed` option to OptionsAuthenticator
- **PushMe:** adds PushMe package


<a name="2.13.1"></a>
## [2.13.1] - 2025-01-13
### Code Refactoring
- **Response:** Refactor is() method

### Pull Requests
- Merge pull request [#136](https://github.com/guanguans/notify/issues/136) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.2


<a name="2.13.0"></a>
## [2.13.0] - 2025-01-09
### Build
- **dependencies:** Update development dependencies versions

### CI
- **config:** Update PHPStan baseline and error configurations
- **core:** Update copyright year to 2025
- **workflows:** Add PHP 8.4 to test matrix

### Features
- **response:** Add fluent method for JSON response handling

### Pull Requests
- Merge pull request [#135](https://github.com/guanguans/notify/issues/135) from guanguans/dependabot/composer/rector/rector-tw-1.2or-tw-2.0
- Merge pull request [#134](https://github.com/guanguans/notify/issues/134) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.1
- Merge pull request [#133](https://github.com/guanguans/notify/issues/133) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.0
- Merge pull request [#132](https://github.com/guanguans/notify/issues/132) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.87.2
- Merge pull request [#131](https://github.com/guanguans/notify/issues/131) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.87.1
- Merge pull request [#130](https://github.com/guanguans/notify/issues/130) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.86.1
- Merge pull request [#129](https://github.com/guanguans/notify/issues/129) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.86.0
- Merge pull request [#127](https://github.com/guanguans/notify/issues/127) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.85.0
- Merge pull request [#126](https://github.com/guanguans/notify/issues/126) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.84.2
- Merge pull request [#122](https://github.com/guanguans/notify/issues/122) from guanguans/dependabot/github_actions/codecov/codecov-action-5
- Merge pull request [#125](https://github.com/guanguans/notify/issues/125) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.84.1
- Merge pull request [#124](https://github.com/guanguans/notify/issues/124) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.84.0
- Merge pull request [#123](https://github.com/guanguans/notify/issues/123) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.83.7


<a name="2.12.4"></a>
## [2.12.4] - 2024-11-15
### Features
- **Response:** Add rawStream method for temporary resources
- **Response:** Add stream method to retrieve body as stream

### Performance Improvements
- **Response:** Improve documentation for collect method

### Tests
- **Response:** Refactor saveAs method and add new test case


<a name="2.12.3"></a>
## [2.12.3] - 2024-11-14
### Build
- **dependencies:** Update phpstan versions and ai-commit commands

### CI
- **chglog:** Update configuration for commit types

### Docs
- **README:** Add blank line for Markdown formatting
- **readme:** Add example for DingTalk client usage

### Features
- **response:** Add resource method to retrieve response body

### Pull Requests
- Merge pull request [#121](https://github.com/guanguans/notify/issues/121) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.83.6
- Merge pull request [#120](https://github.com/guanguans/notify/issues/120) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.83.5
- Merge pull request [#119](https://github.com/guanguans/notify/issues/119) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.83.4
- Merge pull request [#118](https://github.com/guanguans/notify/issues/118) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.83.3
- Merge pull request [#117](https://github.com/guanguans/notify/issues/117) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.83.2
- Merge pull request [#116](https://github.com/guanguans/notify/issues/116) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.83.0
- Merge pull request [#115](https://github.com/guanguans/notify/issues/115) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.13
- Merge pull request [#114](https://github.com/guanguans/notify/issues/114) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.12
- Merge pull request [#113](https://github.com/guanguans/notify/issues/113) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.11
- Merge pull request [#112](https://github.com/guanguans/notify/issues/112) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.9
- Merge pull request [#111](https://github.com/guanguans/notify/issues/111) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.8
- Merge pull request [#110](https://github.com/guanguans/notify/issues/110) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.7


<a name="2.12.2"></a>
## [2.12.2] - 2024-10-01
### Code Refactoring
- **ServerChan:** refactor Authenticator and Message classes

### Docs
- **README:** Improve HandlerStackResolver example
- **README:** Update client handler setup instructions

### Features
- **Authenticator:** update base URI construction logic
- **Message:** add tags method and property
- **rector:** add sensitive parameter attribute rector

### Tests
- **ServerChan:** refactor message sending test to use dynamic key

### Pull Requests
- Merge pull request [#109](https://github.com/guanguans/notify/issues/109) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.6
- Merge pull request [#108](https://github.com/guanguans/notify/issues/108) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.5
- Merge pull request [#107](https://github.com/guanguans/notify/issues/107) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.3
- Merge pull request [#105](https://github.com/guanguans/notify/issues/105) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.2
- Merge pull request [#104](https://github.com/guanguans/notify/issues/104) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.1


<a name="2.12.1"></a>
## [2.12.1] - 2024-09-09
### Code Refactoring
- **http-client:** rename method and streamline middleware handling
- **http-client:** simplify http client resolver logic

### Docs
- **readme:** update middleware usage in client handler

### Features
- **http-client:** add default middleware method


<a name="2.12.0"></a>
## [2.12.0] - 2024-09-09
### Code Refactoring
- **http:** Add handlerStackResolver to Client

### Docs
- **http-client:** Update type hints for resolvers
- **readme:** add coroutine handler example

### Features
- **Client:** add getter and setter for authenticator
- **http-client:** add handler stack resolver methods
- **rector:** add ChangeMethodVisibilityRector configuration

### Tests
- **client:** add tests for setting authenticator and handler stack resolver

### Pull Requests
- Merge pull request [#103](https://github.com/guanguans/notify/issues/103) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.81.10


<a name="2.11.10"></a>
## [2.11.10] - 2024-08-21
### Code Refactoring
- **messages:** rename toHttpOptions to toPayload

### Tests
- **HasOptions:** add validation checks for options


<a name="2.11.9"></a>
## [2.11.9] - 2024-08-16
### Docs
- **README:** Add JetBrains logo and link

### Pull Requests
- Merge pull request [#102](https://github.com/guanguans/notify/issues/102) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.81.9
- Merge pull request [#101](https://github.com/guanguans/notify/issues/101) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.81.8
- Merge pull request [#100](https://github.com/guanguans/notify/issues/100) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.81.7
- Merge pull request [#99](https://github.com/guanguans/notify/issues/99) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.81.6
- Merge pull request [#98](https://github.com/guanguans/notify/issues/98) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.81.5
- Merge pull request [#97](https://github.com/guanguans/notify/issues/97) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.81.4
- Merge pull request [#96](https://github.com/guanguans/notify/issues/96) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.80.5
- Merge pull request [#95](https://github.com/guanguans/notify/issues/95) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.80.4
- Merge pull request [#94](https://github.com/guanguans/notify/issues/94) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.80.3
- Merge pull request [#93](https://github.com/guanguans/notify/issues/93) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.80.2


<a name="2.11.8"></a>
## [2.11.8] - 2024-07-22
### Performance Improvements
- **src:** improve performance by using const instead of define

### Style
- **generate-ide-json:** improve readability of filter and pipe functions


<a name="2.11.7"></a>
## [2.11.7] - 2024-07-19
### Build
- **deps:** update guzzlehttp/guzzle version

### Docs
- Add completion.jpg image
- **ServerChan:** update links in README

### Features
- **generate-ide-json:** add script to generate ide.json for PHP IDE assistance
- **ide:** Add completions for staticStrings and classFields

### Pull Requests
- Merge pull request [#92](https://github.com/guanguans/notify/issues/92) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.80.1
- Merge pull request [#90](https://github.com/guanguans/notify/issues/90) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.80.0


<a name="2.11.6"></a>
## [2.11.6] - 2024-07-16
### Docs
- **benchmark:** update benchmark results

### Tests
- **benchmarks:** rename NotifyBench.php to SendMessageBench.php


<a name="2.11.5"></a>
## [2.11.5] - 2024-07-16
### Docs
- **benchmark:** Add benchmarking command to README.md

### Tests
- Update benchmark command in composer.json
- Add phpbench for benchmarking


<a name="2.11.4"></a>
## [2.11.4] - 2024-07-10
### Code Refactoring
- **utils:** update Utils references

### Features
- **Utils:** add normalizeHttpOptions method


<a name="2.11.3"></a>
## [2.11.3] - 2024-07-09
### Performance Improvements
- **src:** improve performance of Client pool method


<a name="2.11.2"></a>
## [2.11.2] - 2024-07-09
### CI
- **psalm:** update psalm baseline

### Docs
- **Client:** Add link to Guzzle documentation


<a name="2.11.1"></a>
## [2.11.1] - 2024-07-09
### Docs
- **docs:** add additional code examples to README.md
- **types:** Update PHPDoc comments for type hints in Client class

### Tests
- **test:** add test for concurrent message sending


<a name="2.11.0"></a>
## [2.11.0] - 2024-07-09
### CI
- **composer-require-checker:** Add GuzzleHttp PromiseInterface and Utils

### Features
- **Client:** add pool method to handle multiple messages asynchronously
- **Client:** add asynchronous message sending capability


<a name="2.10.0"></a>
## [2.10.0] - 2024-07-09
### Code Refactoring
- **messages:** refactor postFor method in PostMessage class
- **tests:** refactor create_response to response


<a name="2.9.0"></a>
## [2.9.0] - 2024-07-08
### Build
- **composer.json:** update dependencies versions

### CI
- **release:** update rector.php configuration

### Features
- **authenticators:** improve constructor parameter formatting

### Pull Requests
- Merge pull request [#89](https://github.com/guanguans/notify/issues/89) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.2.0
- Merge pull request [#88](https://github.com/guanguans/notify/issues/88) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.79.0
- Merge pull request [#87](https://github.com/guanguans/notify/issues/87) from guanguans/dependabot/composer/brainmaestro/composer-git-hooks-tw-2.8or-tw-3.0
- Merge pull request [#86](https://github.com/guanguans/notify/issues/86) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.78.2


<a name="2.8.4"></a>
## [2.8.4] - 2024-06-14
### Bug Fixes
- **Support:** Fix undefined constant issue

### CI
- **psalm:** Update psalm baseline and remove unused closure param

### Tests
- **test:** add tests for form params, query, and Multipart conversion


<a name="2.8.3"></a>
## [2.8.3] - 2024-06-14
### CI
- **composer.json:** Add pest-highest and putenvs scripts

### Features
- **Message:** Add new methods to handle form parameters, query strings, and multipart data


<a name="2.8.2"></a>
## [2.8.2] - 2024-06-13
### Bug Fixes
- **HasOptions:** Fix offsetGet method


<a name="2.8.1"></a>
## [2.8.1] - 2024-06-13
### Build
- **php-cs-fixer:** Add parallel config support

### Pull Requests
- Merge pull request [#84](https://github.com/guanguans/notify/issues/84) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.78.1
- Merge pull request [#83](https://github.com/guanguans/notify/issues/83) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.78.0
- Merge pull request [#82](https://github.com/guanguans/notify/issues/82) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.77.0
- Merge pull request [#81](https://github.com/guanguans/notify/issues/81) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.76.3
- Merge pull request [#80](https://github.com/guanguans/notify/issues/80) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.76.2
- Merge pull request [#79](https://github.com/guanguans/notify/issues/79) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.76.1
- Merge pull request [#78](https://github.com/guanguans/notify/issues/78) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.76.0


<a name="2.8.0"></a>
## [2.8.0] - 2024-05-10
### Features
- **WPush:** Add WPush package with Authenticator, Client, Message classes and README.md file
- **tests:** add ClientTest for WPush


<a name="2.7.0"></a>
## [2.7.0] - 2024-05-10
### Docs
- **readme:** update push notification SDK list

### Features
- **AnPush:** add ClientTest.php for sending message
- **AnPush:** Add AnPush Authenticator, Client, and Message classes


<a name="2.6.1"></a>
## [2.6.1] - 2024-05-09
### Pull Requests
- Merge pull request [#77](https://github.com/guanguans/notify/issues/77) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.75.1
- Merge pull request [#76](https://github.com/guanguans/notify/issues/76) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.75.0
- Merge pull request [#75](https://github.com/guanguans/notify/issues/75) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.1.0
- Merge pull request [#74](https://github.com/guanguans/notify/issues/74) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.74.0


<a name="2.6.0"></a>
## [2.6.0] - 2024-04-22
### Tests
- Add tests for getting headers and reason in Response class

### Pull Requests
- Merge pull request [#72](https://github.com/guanguans/notify/issues/72) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.73.0
- Merge pull request [#71](https://github.com/guanguans/notify/issues/71) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.72.0
- Merge pull request [#70](https://github.com/guanguans/notify/issues/70) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.71.2
- Merge pull request [#69](https://github.com/guanguans/notify/issues/69) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.71.1
- Merge pull request [#68](https://github.com/guanguans/notify/issues/68) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.71.0


<a name="2.5.1"></a>
## [2.5.1] - 2024-03-22
### Code Refactoring
- **Response:** improve request and response summary handling

### Pull Requests
- Merge pull request [#67](https://github.com/guanguans/notify/issues/67) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.0.0
- Merge pull request [#66](https://github.com/guanguans/notify/issues/66) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.70.3


<a name="2.5.0"></a>
## [2.5.0] - 2024-03-20
### Features
- **SimplePush:** Add SimplePush package with Authenticator, Client, and Messages

### Tests
- **SimplePush:** add test case for sending message


<a name="2.4.3"></a>
## [2.4.3] - 2024-03-20
### Pull Requests
- Merge pull request [#65](https://github.com/guanguans/notify/issues/65) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.70.2
- Merge pull request [#64](https://github.com/guanguans/notify/issues/64) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.70.0


<a name="2.4.2"></a>
## [2.4.2] - 2024-03-12
### CI
- apply php-cs-fixer

### Code Refactoring
- **utils:** Improve property retrieval in Utils class
- **utils:** improve handling of properties in Utils class

### Docs
- **readme:** Add list of supported Push notification SDKs

### Style
- **.php-cs-fixer:** improve code style and remove redundant rules
- **.php-cs-fixer.php:** update coding style rules


<a name="2.4.1"></a>
## [2.4.1] - 2024-03-11
### Code Refactoring
- **HasOptions:** Improve preConfigureOptionsResolver method
- **platform-lint:** Update platform handling and documentation
- **tests:** Improve HasOptionsTest.php test coverage
- **utils:** Use Utils::definedFor() method in HasOptions

### Docs
- Update push notification SDK list in README

### Features
- **Utils:** Add method to get defined properties for an object


<a name="2.4.0"></a>
## [2.4.0] - 2024-03-10
### CI
- apply php-cs-fixer

### Code Refactoring
- improve StringToClassConstantRector
- **rector:** Update namespace for rector classes
- **utils:** Rename getHttpOptionsConstants to httpOptionConstants
- **utils:** improve user agent method
- **utils:** Improve clarity and consistency in multipartFor method

### Features
- **helper:** add error_silencer function
- **src:** Add Method interface and related RFCs
- **tests:** add Faker trait for generating fake data

### Pull Requests
- Merge pull request [#61](https://github.com/guanguans/notify/issues/61) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.69.0


<a name="2.3.1"></a>
## [2.3.1] - 2024-03-08
### Code Refactoring
- **Authenticator:** improve constructor logic
- **HasHttpClient:** adjust multipart options handling
- **HasHttpClient:** Improve HTTP client options handling
- **Utils:** improve multipartFor method
- **Utils:** Improve handling of contents in Utils class

### Features
- **Utils:** Add userAgent method to generate user agent string
- **httpclient:** Add User-Agent header to HTTP requests

### Tests
- **AuthenticatorTest:** add tests for Authenticator class


<a name="2.3.0"></a>
## [2.3.0] - 2024-03-08
### Features
- **pushbullet:** add PushBullet integration

### Tests
- **PushBullet:** add test for sending message functionality

### Pull Requests
- Merge pull request [#60](https://github.com/guanguans/notify/issues/60) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.68.5


<a name="2.2.1"></a>
## [2.2.1] - 2024-03-07
### Code Refactoring
- **Message:** Improve JSON serialization method
- **auth:** Improve CompactToVariablesRector
- **debug:** Use mergeDebugInfo instead of withDebugInfo
- **http:** Normalize HTTP options handling
- **options:** Improve options handling and validation
- **uri:** improve UriTemplateAuthenticator applyToRequest method

### Docs
- **README:** Update baseUri parameter in code comments

### Features
- **Str:** Add kebab case conversion method
- **php:** Add StringToClassConstantRector for GuzzleHttp RequestOptions
- **platform-lint:** Add platform-lint script for linting platforms
- **tests:** add new test files for Foundation

### Tests
- **MessageTest:** add validation for options


<a name="2.2.0"></a>
## [2.2.0] - 2024-03-06
### Code Refactoring
- **AsBody:** improve handling of message body serialization
- **HasHttpClient:** configure HTTP options in getHttpClient method
- **HasOptions:** Improve options handling
- **core:** Update toPayload method in Message classes
- **core:** Improve payload handling in HTTP request options
- **http:** improve HTTP client configuration
- **rectors:** Move rector classes to appropriate namespace

### Features
- **Client:** Add __debugInfo method for debugging
- **HasHttpClient:** Add ability to set HttpClientResolver
- **tests:** add AsNullUri to Message class and update PostMessage structure


<a name="2.1.2"></a>
## [2.1.2] - 2024-03-05
### Code Refactoring
- Remove unnecessary trait use in rector.php
- **HasOptionsDocCommentRector:** Sort properties in alphabetical order
- **Message:** Improve attachment handling in Message class
- **Message:** improve default options handling
- **Message:** Improve addAction method and configureOptionsResolver
- **Message:** Improve embed configuration handling
- **commit:** refactor configureAndResolveOptions method
- **core:** update HTTP method definitions
- **message:** Refactor message classes for NowPush
- **message:** Improve section and potential action handling
- **postmessage:** Improve language-specific post setting

### Features
- **NewsMessage:** add method to configure options for articles
- **auth:** add OptionsAuthenticator and mergeHttpOptions method

### Pull Requests
- Merge pull request [#59](https://github.com/guanguans/notify/issues/59) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.68.4


<a name="2.1.1"></a>
## [2.1.1] - 2024-03-04
### Code Refactoring
- **client:** Remove Makeable trait from Client class
- **media:** Improve media handling in MediaGroupMessage
- **message:** Improve make method in Message class
- **pushplus:** Rename Pushplus to PushPlus and update namespaces

### Docs
- Update push notification SDK list

### Features
- **Telegram:** Add support for multipart requests in Telegram messages
- **dingtalk:** add DingTalk notification support
- **extract-platform:** add script to extract platform information
- **messages:** Add toHttpUri method for sending various message types
- **telegram:** Add AsJson trait to GetUpdatesMessage and ClientTest
- **telegram:** Add constructor to Client class


<a name="2.1.0"></a>
## [2.1.0] - 2024-03-03
### Code Refactoring
- **tests:** improve assertCanSendMessage method

### Features
- **PushDeer:** Add PushDeer service with related classes


<a name="2.0.6"></a>
## [2.0.6] - 2024-03-02
### Code Refactoring
- **Message:** Remove redundant array definition
- **TemplateCardMessage:** optimize options configuration
- **message:** Update message classes structure

### Features
- **Message:** add delayMilliseconds and url methods
- **Slack:** Add metadata to Message options
- **Zulip:** add Message class with message creation methods
- **messages:** add type, date, and time properties
- **messages:** Add support for FileMessage and TemplateCardMessage


<a name="2.0.5"></a>
## [2.0.5] - 2024-03-02
### Docs
- **ShowdocPush:** Update ShowdocPush documentation
- **slack:** Update Slack Message class methods and properties

### Features
- **Message:** Add channel, webhook, callbackUrl, and timestamp properties to Message class
- **QQ:** add constructor to Client class
- **RocketChat:** Add message sending functionality with attachments

### Tests
- **ClientTest:** Add new message fields
- **ClientTest:** refactor message creation in ClientTest
- **ClientTest:** Add attachment and device to message


<a name="2.0.4"></a>
## [2.0.4] - 2024-03-01
### Code Refactoring
- **Response:** Improve handling of decoded JSON response
- **httpclient:** optimize setting http options
- **messages:** Update message classes with new traits and methods
- **push:** Update Authenticator to use AggregateAuthenticator and PayloadAuthenticator
- **pushback:** Remove commented out code and update URLs in README

### Features
- **Push:** add support for different message types

### Tests
- **ClientTest:** update message sending feature


<a name="2.0.3"></a>
## [2.0.3] - 2024-02-29
### Code Refactoring
- **ClientTest:** Refactor test cases for sending messages
- **Message:** Remove base_uri usage and update toHttpUri method
- **Message:** Improve Message class structure
- **Message:** Optimize 'toHttpOptions' method
- **arr:** Improve array handling in Arr class
- **messages:** Improve array filtering in Message class
- **tests:** improve custom expectation function naming
- **types:** Update type declarations to bool in message classes

### Docs
- **readme:** update Gitter links and remove Gitter from phpunit.xml.dist

### Features
- **GoogleChat:** Add compact payload creation in Authenticator
- **IGot:** Add title, url, copy, and detail to message
- **Message:** Add support for [@type](https://github.com/type) and [@context](https://github.com/context) in Message
- **MicrosoftTeams:** Add test for sending message

### Tests
- Add Mattermost ClientTest and update Message.php
- Add Gitter and GoogleChat ClientTest files

### Pull Requests
- Merge pull request [#58](https://github.com/guanguans/notify/issues/58) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.68.3


<a name="2.0.2"></a>
## [2.0.2] - 2024-02-28
### Code Refactoring
- **Message:** update message class properties and methods
- **MockHandler:** Remove unnecessary code and improve readability
- **tests:** Update ClientTest.php for message sending functionality

### Features
- **Chanify:** add support for audio, file, and image messages
- **Discord:** Add ability to send messages with rich content
- **Pest:** add assertCanSendMessage expectation

### Tests
- **ClientTest:** Refactor message creation in ClientTest


<a name="2.0.1"></a>
## [2.0.1] - 2024-02-27
### Code Refactoring
- **HasOptions:** Improve handling of defined and required options
- **HasOptions:** update deprecated options handling
- **tests:** rename wsse authenticator test file and add certificate authenticator test

### Docs
- Add README.md files for various messaging platforms
- **HasOptions:** Add support for nested options

### Features
- **notifications:** Add Bark notification support
- **options:** Add support for ignoreUndefined property
- **support:** Improve array handling in HasHttpClient

### Tests
- Add unit tests for Client and Message classes
- add CertificateAuthenticatorTest and WsseAuthenticatorTest

### Pull Requests
- Merge pull request [#57](https://github.com/guanguans/notify/issues/57) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.68.2


<a name="2.0.0"></a>
## [2.0.0] - 2024-02-26
### Code Refactoring
- **concerns:** Update mixin references in traits
- **debug:** Improve debug info handling

### Features
- **Message:** Add __debugInfo method
- **Utils:** Add objectWithDebugInfo method


<a name="2.0.0-rc1"></a>
## [2.0.0-rc1] - 2024-02-23
### Code Refactoring
- **HasOptions:** Remove resolveOptions method and update getOption method
- **Response:** improve response class structure and add new methods
- **http:** Ensure required middleware in HasHttpClient trait
- **utils:** Rename method to more descriptive name

### Features
- **composer:** add illuminate/collections dependency


<a name="2.0.0-beta3"></a>
## [2.0.0-beta3] - 2024-02-22
### Code Refactoring
- **Exceptions:** Remove unused exception classes
- **src:** Improve code readability and remove redundant functions
- **src:** Update ToInternalExceptionRector to handle new class nodes

### Features
- **Notify:** Add WithDumpable trait and dump method
- **Response:** Add __debugInfo method for Response class
- **ToInternalExceptionRector:** Add ToInternalExceptionRector rule
- **ToInternalExceptionRector:** Add ToInternalExceptionRector for internal exceptions handling

### Pull Requests
- Merge pull request [#56](https://github.com/guanguans/notify/issues/56) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.68.0


<a name="2.0.0-beta2"></a>
## [2.0.0-beta2] - 2024-02-21
### Code Refactoring
- **client:** remove Conditionable and Tappable traits
- **concerns:** rename Traits to Concerns
- **doc:** Update Http client doc comment
- **doc:** Has options doc comment
- **utils:** Improve readability of getHttpOptionsConstants method

### Features
- **ClientTest:** add support for sending different types of messages
- **YiFengChuanHua:** add ClientTest.php for sending message
- **utils:** Add Utils class for converting form array into multipart array
- **zulip:** add test for sending direct message

### Tests
- **Chanify:** Add tests for sending text and link messages
- **ClientTest:** Add test case for sending message
- **ClientTest:** Add test case for sending message
- **ClientTest:** Add test for sending text message
- **ClientTest:** add test for sending message functionality
- **ClientTest:** add test for sending text messages
- **Discord:** add test case for sending message
- **IGot:** Add test case for sending message
- **Push:** Add ClientTest.php for message sending functionality
- **PushBack:** add ClientTest.php for testing sending messages
- **PushPlus:** Add test for sending message
- **Pushover:** add test for sending message
- **RocketChat:** add test case for sending message
- **ServerChan:** Add ClientTest.php for ServerChan client testing
- **Showdoc:** Add test for sending message
- **Slack:** Add test case for sending a message
- **WeWorkGroupBot:** add test for sending message
- **XiZhi:** add single and channel message test cases
- **telegram:** Add test case for sending a message via Telegram client

### Pull Requests
- Merge pull request [#55](https://github.com/guanguans/notify/issues/55) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.67.7
- Merge pull request [#51](https://github.com/guanguans/notify/issues/51) from guanguans/dependabot/github_actions/codecov/codecov-action-4
- Merge pull request [#54](https://github.com/guanguans/notify/issues/54) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.67.6


<a name="2.0.0-beta1"></a>
## [2.0.0-beta1] - 2024-02-19
### Code Refactoring
- Improve DocCommentRector and HasOptions
- Update credentials classes
- **Credentials:** Update ApiKeyCredential, DigestAuthCredential, HeaderCredential, and QueryCredential
- **HasHttpClient:** refactor mock method
- **Message:** Update toHttpUri() method
- **MockHandler:** improve MockHandler class structure and functionality
- **Response:** improve Response class
- **Str:** Improve case conversion methods
- **Traits:** Improve HasOptions trait
- **UpdateHasHttpClientDocCommentRector:** Update createMethodPhpDocTagNode method
- **client:** remove unused methods and add missing method
- **client:** Refactor the Client class
- **concerns:** Update options handling in traits
- **concerns:** Remove unused imports
- **config:** update PHP version and sets
- **credentials:** refactor credential classes
- **credentials:** refactor BasicAuthCredential, CallbackCredential, DigestAuthCredential, NtlmAuthCredential, and WsseAuthCredential classes
- **handler:** refactor MockHandler constructor and response handling
- **headercredential:** refactor applyToRequest method
- **helper:** Refactor to_multipart function
- **http-client:** Refactor HasHttpClient trait
- **httpclient:** refactor send method
- **middleware:** Refactor ApplyAuthenticatorToRequest and EnsureResponse middleware
- **options:** Improve options handling in Traits

### Docs
- Update links and add examples for RocketChat and Slack clients

### Features
- **Client:** add async method for sending messages
- **DocCommentRector:** Add DocCommentRector class
- **HasHttpClient:** Add mock method
- **Notify:** add delete, head, patch, and put methods
- **bark:** add Bark client, credential, and message classes
- **client:** Add EnsureResponse middleware
- **commit:** Add Conditionable and Macroable traits
- **credentials:** add AggregateCredential class
- **credentials:** add CertificateCredential class
- **github:** add secrets check workflow
- **mock:** add MockHandler class
- **tests:** add XiZhi\ClientTest

### Pull Requests
- Merge pull request [#53](https://github.com/guanguans/notify/issues/53) from guanguans/1.x
- Merge pull request [#52](https://github.com/guanguans/notify/issues/52) from guanguans/dependabot/composer/rector/rector-tw-0.19or-tw-1.0
- Merge pull request [#50](https://github.com/guanguans/notify/issues/50) from guanguans/dependabot/github_actions/actions/setup-node-4
- Merge pull request [#49](https://github.com/guanguans/notify/issues/49) from guanguans/dependabot/github_actions/actions/cache-4


<a name="1.28.0"></a>
## [1.28.0] - 2024-01-17

<a name="1.27.2"></a>
## [1.27.2] - 2024-01-17
### Features
- **.zhlintrc:** add .zhlintrc file

### Tests
- **rocketChat:** Skip RocketChat test

### Pull Requests
- Merge pull request [#48](https://github.com/guanguans/notify/issues/48) from guanguans/dependabot/composer/rector/rector-tw-0.17or-tw-0.18or-tw-0.19
- Merge pull request [#47](https://github.com/guanguans/notify/issues/47) from guanguans/dependabot/github_actions/actions/stale-9
- Merge pull request [#46](https://github.com/guanguans/notify/issues/46) from guanguans/dependabot/github_actions/actions/labeler-5


<a name="1.27.1"></a>
## [1.27.1] - 2023-10-19
### Docs
- **readme:** update README links


<a name="1.27.0"></a>
## [1.27.0] - 2023-10-07
### Bug Fixes
- **client:** Update PushPlus request URL

### Tests
- **QqChannelBotTest:** Skip testQqChannelBot


<a name="1.26.1"></a>
## [1.26.1] - 2023-10-07
### Pull Requests
- Merge pull request [#45](https://github.com/guanguans/notify/issues/45) from guanguans/dependabot/github_actions/stefanzweifel/git-auto-commit-action-5
- Merge pull request [#43](https://github.com/guanguans/notify/issues/43) from guanguans/dependabot/github_actions/codecov/codecov-action-4
- Merge pull request [#42](https://github.com/guanguans/notify/issues/42) from guanguans/dependabot/github_actions/actions/checkout-4
- Merge pull request [#40](https://github.com/guanguans/notify/issues/40) from guanguans/dependabot/composer/rector/rector-tw-0.17or-tw-0.18


<a name="1.26.0"></a>
## [1.26.0] - 2023-08-16
### Bug Fixes
- **composer:** Resolve conflict with symplify/monorepo-builder

### CI
- **psalm.xml.dist:** update psalm config file

### Code Refactoring
- **src:** apply rector

### Docs
- **readme:** update README-EN.md and README.md

### Features
- **monorepo-builder:** add new monorepo-builder.php file

### Pull Requests
- Merge pull request [#38](https://github.com/guanguans/notify/issues/38) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.6.0
- Merge pull request [#37](https://github.com/guanguans/notify/issues/37) from guanguans/dependabot/composer/dms/phpunit-arraysubset-asserts-tw-0.4.0or-tw-0.5.0
- Merge pull request [#36](https://github.com/guanguans/notify/issues/36) from guanguans/dependabot/composer/rector/rector-tw-0.15.7or-tw-0.16.0or-tw-0.17.0
- Merge pull request [#35](https://github.com/guanguans/notify/issues/35) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.5.1
- Merge pull request [#34](https://github.com/guanguans/notify/issues/34) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.5.0
- Merge pull request [#33](https://github.com/guanguans/notify/issues/33) from guanguans/dependabot/composer/rector/rector-tw-0.15.7or-tw-0.16.0
- Merge pull request [#32](https://github.com/guanguans/notify/issues/32) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.4.0
- Merge pull request [#30](https://github.com/guanguans/notify/issues/30) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.3.6


<a name="v1.25.1"></a>
## [v1.25.1] - 2023-01-19

<a name="v1.25.0"></a>
## [v1.25.0] - 2023-01-18
### Pull Requests
- Merge pull request [#29](https://github.com/guanguans/notify/issues/29) from teakong/feature-yifengchuanhua
- Merge pull request [#26](https://github.com/guanguans/notify/issues/26) from guanguans/dependabot/composer/rector/rector-tw-0.14or-tw-0.15


<a name="v1.24.1"></a>
## [v1.24.1] - 2022-11-15

<a name="v1.24.0"></a>
## [v1.24.0] - 2022-11-14

<a name="v1.23.0"></a>
## [v1.23.0] - 2022-11-14
### Pull Requests
- Merge pull request [#24](https://github.com/guanguans/notify/issues/24) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.3.5


<a name="v1.22.2"></a>
## [v1.22.2] - 2022-11-02

<a name="v1.22.1"></a>
## [v1.22.1] - 2022-11-01

<a name="v1.22.0"></a>
## [v1.22.0] - 2022-11-01
### Pull Requests
- Merge pull request [#23](https://github.com/guanguans/notify/issues/23) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.3.4


<a name="v1.21.3"></a>
## [v1.21.3] - 2022-09-12

<a name="v1.21.2"></a>
## [v1.21.2] - 2022-09-11
### Pull Requests
- Merge pull request [#21](https://github.com/guanguans/notify/issues/21) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.3.3
- Merge pull request [#20](https://github.com/guanguans/notify/issues/20) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.3.2


<a name="v1.21.1"></a>
## [v1.21.1] - 2022-06-09

<a name="v1.21.0"></a>
## [v1.21.0] - 2022-06-09

<a name="v1.20.1"></a>
## [v1.20.1] - 2022-06-09
### Pull Requests
- Merge pull request [#17](https://github.com/guanguans/notify/issues/17) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.3.1
- Merge pull request [#16](https://github.com/guanguans/notify/issues/16) from guanguans/dependabot/github_actions/codecov/codecov-action-3


<a name="v1.20.0"></a>
## [v1.20.0] - 2022-03-31

<a name="v1.19.2"></a>
## [v1.19.2] - 2022-03-28
### Pull Requests
- Merge pull request [#13](https://github.com/guanguans/notify/issues/13) from guanguans/issue-12-替换wrench/wrench为Textalk/websocket-php


<a name="v1.19.1"></a>
## [v1.19.1] - 2022-03-26

<a name="v1.19.0"></a>
## [v1.19.0] - 2022-03-26

<a name="v1.18.2"></a>
## [v1.18.2] - 2022-03-23

<a name="v1.18.1"></a>
## [v1.18.1] - 2022-03-23

<a name="v1.18.0"></a>
## [v1.18.0] - 2022-03-22

<a name="v1.17.0"></a>
## [v1.17.0] - 2022-03-22

<a name="v1.16.0"></a>
## [v1.16.0] - 2022-03-22
### Pull Requests
- Merge pull request [#11](https://github.com/guanguans/notify/issues/11) from guanguans/dependabot/github_actions/actions/cache-3


<a name="v1.15.0"></a>
## [v1.15.0] - 2022-03-21

<a name="v1.14.1"></a>
## [v1.14.1] - 2022-03-21

<a name="v1.14.0"></a>
## [v1.14.0] - 2022-03-21
### Pull Requests
- Merge pull request [#10](https://github.com/guanguans/notify/issues/10) from devcto/pushdeer


<a name="v1.13.2"></a>
## [v1.13.2] - 2022-03-14
### Pull Requests
- Merge pull request [#8](https://github.com/guanguans/notify/issues/8) from guanguans/dependabot/github_actions/actions/checkout-3
- Merge pull request [#9](https://github.com/guanguans/notify/issues/9) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.3.0
- Merge pull request [#7](https://github.com/guanguans/notify/issues/7) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.2.1


<a name="v1.13.1"></a>
## [v1.13.1] - 2022-02-22

<a name="v1.13.0"></a>
## [v1.13.0] - 2022-02-22

<a name="v1.12.1"></a>
## [v1.12.1] - 2022-01-09

<a name="v1.12.0"></a>
## [v1.12.0] - 2022-01-09

<a name="v1.11.1"></a>
## [v1.11.1] - 2022-01-09

<a name="v1.11.0"></a>
## [v1.11.0] - 2022-01-08

<a name="v1.10.0"></a>
## [v1.10.0] - 2022-01-06

<a name="v1.9.1"></a>
## [v1.9.1] - 2022-01-06

<a name="v1.9.0"></a>
## [v1.9.0] - 2022-01-06

<a name="v1.8.2"></a>
## [v1.8.2] - 2022-01-06

<a name="v1.8.1"></a>
## [v1.8.1] - 2022-01-05

<a name="v1.8.0"></a>
## [v1.8.0] - 2022-01-05

<a name="v1.7.2"></a>
## [v1.7.2] - 2021-12-12

<a name="v1.7.1"></a>
## [v1.7.1] - 2021-12-12

<a name="v1.7.0"></a>
## [v1.7.0] - 2021-12-12

<a name="v1.6.0"></a>
## [v1.6.0] - 2021-12-11

<a name="v1.5.0"></a>
## [v1.5.0] - 2021-12-10

<a name="v1.4.4"></a>
## [v1.4.4] - 2021-12-10

<a name="v1.4.3"></a>
## [v1.4.3] - 2021-12-10

<a name="v1.4.2"></a>
## [v1.4.2] - 2021-12-10

<a name="v1.4.1"></a>
## [v1.4.1] - 2021-12-10

<a name="v1.4.0"></a>
## [v1.4.0] - 2021-12-09

<a name="v1.3.1"></a>
## [v1.3.1] - 2021-12-09

<a name="v1.3.0"></a>
## [v1.3.0] - 2021-12-09

<a name="v1.2.0"></a>
## [v1.2.0] - 2021-12-08

<a name="v1.1.2"></a>
## [v1.1.2] - 2021-12-08

<a name="v1.1.1"></a>
## [v1.1.1] - 2021-12-08

<a name="v1.1.0"></a>
## [v1.1.0] - 2021-12-07

<a name="v1.0.5"></a>
## [v1.0.5] - 2021-12-07

<a name="v1.0.4"></a>
## [v1.0.4] - 2021-10-24

<a name="v1.0.3"></a>
## [v1.0.3] - 2021-10-17
### Build
- **deps-dev:** Update friendsofphp/php-cs-fixer requirement || ^3.0

### Pull Requests
- Merge pull request [#4](https://github.com/guanguans/notify/issues/4) from guanguans/dependabot/composer/friendsofphp/php-cs-fixer-tw-2.16or-tw-3.0


<a name="v1.0.2"></a>
## [v1.0.2] - 2021-10-10
### Build
- **deps:** Bump codecov/codecov-action from 1 to 2.1.0
- **deps-dev:** Update overtrue/phplint requirement || ^3.0
- **deps-dev:** Update vimeo/psalm requirement || ^4.0

### Pull Requests
- Merge pull request [#3](https://github.com/guanguans/notify/issues/3) from guanguans/dependabot/composer/overtrue/phplint-tw-2.3or-tw-3.0
- Merge pull request [#1](https://github.com/guanguans/notify/issues/1) from guanguans/dependabot/github_actions/codecov/codecov-action-2.1.0
- Merge pull request [#2](https://github.com/guanguans/notify/issues/2) from guanguans/dependabot/composer/vimeo/psalm-tw-3.11or-tw-4.0


<a name="v1.0.1"></a>
## [v1.0.1] - 2021-05-16
### Docs
- Update docs

### Features
- Add separate method for separate setting option

### Performance Improvements
- Perf messages
- Perf clients


<a name="v1.0.0"></a>
## v1.0.0 - 2021-05-16
### Bug Fixes
- Fix message with secret

### Code Refactoring
- Refactor
- Refactor
- Refactor FeiShu
- Refactor FeiShu client
- Refactor WeWork client
- Refactor clients
- Refactor Chanify client

### Docs
- Update docs
- Add global `tap` function
- Update README.md
- Update README.md

### Features
- Add some messages for FeiShu
- Add FeiShu client
- Add WeWork client
- Add DingTalk client
- Add Bark client
- Add ServerChan client
- Add XiZhi client
- Add Chanify client

### Performance Improvements
- Perf ServerChan
- Perf XiZhi
- Perf WeWork
- Finish DingTalk
- Finish FeiShu
- Finish WeWork
- Finish ServerChan
- Finish XiZhi
- Finish Chanify
- Finish Bark

### Style
- Fix style

### Tests
- Finish tests


[Unreleased]: https://github.com/guanguans/notify/compare/3.0.1...HEAD
[3.0.1]: https://github.com/guanguans/notify/compare/3.0.0...3.0.1
[3.0.0]: https://github.com/guanguans/notify/compare/2.14.1...3.0.0
[2.14.1]: https://github.com/guanguans/notify/compare/2.14.0...2.14.1
[2.14.0]: https://github.com/guanguans/notify/compare/2.13.1...2.14.0
[2.13.1]: https://github.com/guanguans/notify/compare/2.13.0...2.13.1
[2.13.0]: https://github.com/guanguans/notify/compare/2.12.4...2.13.0
[2.12.4]: https://github.com/guanguans/notify/compare/2.12.3...2.12.4
[2.12.3]: https://github.com/guanguans/notify/compare/2.12.2...2.12.3
[2.12.2]: https://github.com/guanguans/notify/compare/2.12.1...2.12.2
[2.12.1]: https://github.com/guanguans/notify/compare/2.12.0...2.12.1
[2.12.0]: https://github.com/guanguans/notify/compare/2.11.10...2.12.0
[2.11.10]: https://github.com/guanguans/notify/compare/2.11.9...2.11.10
[2.11.9]: https://github.com/guanguans/notify/compare/2.11.8...2.11.9
[2.11.8]: https://github.com/guanguans/notify/compare/2.11.7...2.11.8
[2.11.7]: https://github.com/guanguans/notify/compare/2.11.6...2.11.7
[2.11.6]: https://github.com/guanguans/notify/compare/2.11.5...2.11.6
[2.11.5]: https://github.com/guanguans/notify/compare/2.11.4...2.11.5
[2.11.4]: https://github.com/guanguans/notify/compare/2.11.3...2.11.4
[2.11.3]: https://github.com/guanguans/notify/compare/2.11.2...2.11.3
[2.11.2]: https://github.com/guanguans/notify/compare/2.11.1...2.11.2
[2.11.1]: https://github.com/guanguans/notify/compare/2.11.0...2.11.1
[2.11.0]: https://github.com/guanguans/notify/compare/2.10.0...2.11.0
[2.10.0]: https://github.com/guanguans/notify/compare/2.9.0...2.10.0
[2.9.0]: https://github.com/guanguans/notify/compare/2.8.4...2.9.0
[2.8.4]: https://github.com/guanguans/notify/compare/2.8.3...2.8.4
[2.8.3]: https://github.com/guanguans/notify/compare/2.8.2...2.8.3
[2.8.2]: https://github.com/guanguans/notify/compare/2.8.1...2.8.2
[2.8.1]: https://github.com/guanguans/notify/compare/2.8.0...2.8.1
[2.8.0]: https://github.com/guanguans/notify/compare/2.7.0...2.8.0
[2.7.0]: https://github.com/guanguans/notify/compare/2.6.1...2.7.0
[2.6.1]: https://github.com/guanguans/notify/compare/2.6.0...2.6.1
[2.6.0]: https://github.com/guanguans/notify/compare/2.5.1...2.6.0
[2.5.1]: https://github.com/guanguans/notify/compare/2.5.0...2.5.1
[2.5.0]: https://github.com/guanguans/notify/compare/2.4.3...2.5.0
[2.4.3]: https://github.com/guanguans/notify/compare/2.4.2...2.4.3
[2.4.2]: https://github.com/guanguans/notify/compare/2.4.1...2.4.2
[2.4.1]: https://github.com/guanguans/notify/compare/2.4.0...2.4.1
[2.4.0]: https://github.com/guanguans/notify/compare/2.3.1...2.4.0
[2.3.1]: https://github.com/guanguans/notify/compare/2.3.0...2.3.1
[2.3.0]: https://github.com/guanguans/notify/compare/2.2.1...2.3.0
[2.2.1]: https://github.com/guanguans/notify/compare/2.2.0...2.2.1
[2.2.0]: https://github.com/guanguans/notify/compare/2.1.2...2.2.0
[2.1.2]: https://github.com/guanguans/notify/compare/2.1.1...2.1.2
[2.1.1]: https://github.com/guanguans/notify/compare/2.1.0...2.1.1
[2.1.0]: https://github.com/guanguans/notify/compare/2.0.6...2.1.0
[2.0.6]: https://github.com/guanguans/notify/compare/2.0.5...2.0.6
[2.0.5]: https://github.com/guanguans/notify/compare/2.0.4...2.0.5
[2.0.4]: https://github.com/guanguans/notify/compare/2.0.3...2.0.4
[2.0.3]: https://github.com/guanguans/notify/compare/2.0.2...2.0.3
[2.0.2]: https://github.com/guanguans/notify/compare/2.0.1...2.0.2
[2.0.1]: https://github.com/guanguans/notify/compare/2.0.0...2.0.1
[2.0.0]: https://github.com/guanguans/notify/compare/2.0.0-rc1...2.0.0
[2.0.0-rc1]: https://github.com/guanguans/notify/compare/2.0.0-beta3...2.0.0-rc1
[2.0.0-beta3]: https://github.com/guanguans/notify/compare/2.0.0-beta2...2.0.0-beta3
[2.0.0-beta2]: https://github.com/guanguans/notify/compare/2.0.0-beta1...2.0.0-beta2
[2.0.0-beta1]: https://github.com/guanguans/notify/compare/1.28.0...2.0.0-beta1
[1.28.0]: https://github.com/guanguans/notify/compare/1.27.2...1.28.0
[1.27.2]: https://github.com/guanguans/notify/compare/1.27.1...1.27.2
[1.27.1]: https://github.com/guanguans/notify/compare/1.27.0...1.27.1
[1.27.0]: https://github.com/guanguans/notify/compare/1.26.1...1.27.0
[1.26.1]: https://github.com/guanguans/notify/compare/1.26.0...1.26.1
[1.26.0]: https://github.com/guanguans/notify/compare/v1.25.1...1.26.0
[v1.25.1]: https://github.com/guanguans/notify/compare/v1.25.0...v1.25.1
[v1.25.0]: https://github.com/guanguans/notify/compare/v1.24.1...v1.25.0
[v1.24.1]: https://github.com/guanguans/notify/compare/v1.24.0...v1.24.1
[v1.24.0]: https://github.com/guanguans/notify/compare/v1.23.0...v1.24.0
[v1.23.0]: https://github.com/guanguans/notify/compare/v1.22.2...v1.23.0
[v1.22.2]: https://github.com/guanguans/notify/compare/v1.22.1...v1.22.2
[v1.22.1]: https://github.com/guanguans/notify/compare/v1.22.0...v1.22.1
[v1.22.0]: https://github.com/guanguans/notify/compare/v1.21.3...v1.22.0
[v1.21.3]: https://github.com/guanguans/notify/compare/v1.21.2...v1.21.3
[v1.21.2]: https://github.com/guanguans/notify/compare/v1.21.1...v1.21.2
[v1.21.1]: https://github.com/guanguans/notify/compare/v1.21.0...v1.21.1
[v1.21.0]: https://github.com/guanguans/notify/compare/v1.20.1...v1.21.0
[v1.20.1]: https://github.com/guanguans/notify/compare/v1.20.0...v1.20.1
[v1.20.0]: https://github.com/guanguans/notify/compare/v1.19.2...v1.20.0
[v1.19.2]: https://github.com/guanguans/notify/compare/v1.19.1...v1.19.2
[v1.19.1]: https://github.com/guanguans/notify/compare/v1.19.0...v1.19.1
[v1.19.0]: https://github.com/guanguans/notify/compare/v1.18.2...v1.19.0
[v1.18.2]: https://github.com/guanguans/notify/compare/v1.18.1...v1.18.2
[v1.18.1]: https://github.com/guanguans/notify/compare/v1.18.0...v1.18.1
[v1.18.0]: https://github.com/guanguans/notify/compare/v1.17.0...v1.18.0
[v1.17.0]: https://github.com/guanguans/notify/compare/v1.16.0...v1.17.0
[v1.16.0]: https://github.com/guanguans/notify/compare/v1.15.0...v1.16.0
[v1.15.0]: https://github.com/guanguans/notify/compare/v1.14.1...v1.15.0
[v1.14.1]: https://github.com/guanguans/notify/compare/v1.14.0...v1.14.1
[v1.14.0]: https://github.com/guanguans/notify/compare/v1.13.2...v1.14.0
[v1.13.2]: https://github.com/guanguans/notify/compare/v1.13.1...v1.13.2
[v1.13.1]: https://github.com/guanguans/notify/compare/v1.13.0...v1.13.1
[v1.13.0]: https://github.com/guanguans/notify/compare/v1.12.1...v1.13.0
[v1.12.1]: https://github.com/guanguans/notify/compare/v1.12.0...v1.12.1
[v1.12.0]: https://github.com/guanguans/notify/compare/v1.11.1...v1.12.0
[v1.11.1]: https://github.com/guanguans/notify/compare/v1.11.0...v1.11.1
[v1.11.0]: https://github.com/guanguans/notify/compare/v1.10.0...v1.11.0
[v1.10.0]: https://github.com/guanguans/notify/compare/v1.9.1...v1.10.0
[v1.9.1]: https://github.com/guanguans/notify/compare/v1.9.0...v1.9.1
[v1.9.0]: https://github.com/guanguans/notify/compare/v1.8.2...v1.9.0
[v1.8.2]: https://github.com/guanguans/notify/compare/v1.8.1...v1.8.2
[v1.8.1]: https://github.com/guanguans/notify/compare/v1.8.0...v1.8.1
[v1.8.0]: https://github.com/guanguans/notify/compare/v1.7.2...v1.8.0
[v1.7.2]: https://github.com/guanguans/notify/compare/v1.7.1...v1.7.2
[v1.7.1]: https://github.com/guanguans/notify/compare/v1.7.0...v1.7.1
[v1.7.0]: https://github.com/guanguans/notify/compare/v1.6.0...v1.7.0
[v1.6.0]: https://github.com/guanguans/notify/compare/v1.5.0...v1.6.0
[v1.5.0]: https://github.com/guanguans/notify/compare/v1.4.4...v1.5.0
[v1.4.4]: https://github.com/guanguans/notify/compare/v1.4.3...v1.4.4
[v1.4.3]: https://github.com/guanguans/notify/compare/v1.4.2...v1.4.3
[v1.4.2]: https://github.com/guanguans/notify/compare/v1.4.1...v1.4.2
[v1.4.1]: https://github.com/guanguans/notify/compare/v1.4.0...v1.4.1
[v1.4.0]: https://github.com/guanguans/notify/compare/v1.3.1...v1.4.0
[v1.3.1]: https://github.com/guanguans/notify/compare/v1.3.0...v1.3.1
[v1.3.0]: https://github.com/guanguans/notify/compare/v1.2.0...v1.3.0
[v1.2.0]: https://github.com/guanguans/notify/compare/v1.1.2...v1.2.0
[v1.1.2]: https://github.com/guanguans/notify/compare/v1.1.1...v1.1.2
[v1.1.1]: https://github.com/guanguans/notify/compare/v1.1.0...v1.1.1
[v1.1.0]: https://github.com/guanguans/notify/compare/v1.0.5...v1.1.0
[v1.0.5]: https://github.com/guanguans/notify/compare/v1.0.4...v1.0.5
[v1.0.4]: https://github.com/guanguans/notify/compare/v1.0.3...v1.0.4
[v1.0.3]: https://github.com/guanguans/notify/compare/v1.0.2...v1.0.3
[v1.0.2]: https://github.com/guanguans/notify/compare/v1.0.1...v1.0.2
[v1.0.1]: https://github.com/guanguans/notify/compare/v1.0.0...v1.0.1
