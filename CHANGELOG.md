<!--- BEGIN HEADER -->
# Changelog

All notable changes to this project will be documented in this file.
<!--- END HEADER -->

<a name="unreleased"></a>
## [Unreleased]


<a name="3.3.0"></a>
## [3.3.0] - 2025-11-13
### ✨ Features
- **client:** add support to Zoho Cliq ([d9ddccf](https://github.com/guanguans/notify/commit/d9ddccf))

### 💅 Code Refactorings
- **composer:** Update IDE JSON generation script ([df3cc77](https://github.com/guanguans/notify/commit/df3cc77))
- **support:** Add platform linting functionality ([bffa848](https://github.com/guanguans/notify/commit/bffa848))
- **zoho:** Improve token generation and update dependencies ([b51ab48](https://github.com/guanguans/notify/commit/b51ab48))

### 📦 Builds
- **composer:** Replace pest aliases with lint script ([f65a37f](https://github.com/guanguans/notify/commit/f65a37f))

### 🤖 Continuous Integrations
- update issue templates and secret scanning workflow ([3b2e148](https://github.com/guanguans/notify/commit/3b2e148))
- **issue-template:** Add new bug report template ([bfa8499](https://github.com/guanguans/notify/commit/bfa8499))

### Pull Requests
- Merge pull request [#173](https://github.com/guanguans/notify/issues/173) from ricardoapaes/add-zoho-cliq-integration
- Merge pull request [#172](https://github.com/guanguans/notify/issues/172) from guanguans/dependabot/github_actions/actions/setup-node-6
- Merge pull request [#171](https://github.com/guanguans/notify/issues/171) from guanguans/dependabot/github_actions/stefanzweifel/git-auto-commit-action-7
- Merge pull request [#169](https://github.com/guanguans/notify/issues/169) from guanguans/dependabot/github_actions/actions/setup-node-5
- Merge pull request [#170](https://github.com/guanguans/notify/issues/170) from guanguans/dependabot/github_actions/actions/labeler-6
- Merge pull request [#168](https://github.com/guanguans/notify/issues/168) from guanguans/dependabot/github_actions/actions/stale-10
- Merge pull request [#167](https://github.com/guanguans/notify/issues/167) from guanguans/dependabot/github_actions/actions/checkout-5
- Merge pull request [#166](https://github.com/guanguans/notify/issues/166) from guanguans/dependabot/github_actions/stefanzweifel/git-auto-commit-action-6
- Merge pull request [#165](https://github.com/guanguans/notify/issues/165) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.30
- Merge pull request [#164](https://github.com/guanguans/notify/issues/164) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.4.0
- Merge pull request [#163](https://github.com/guanguans/notify/issues/163) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.29
- Merge pull request [#162](https://github.com/guanguans/notify/issues/162) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.28
- Merge pull request [#161](https://github.com/guanguans/notify/issues/161) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.27
- Merge pull request [#160](https://github.com/guanguans/notify/issues/160) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.26
- Merge pull request [#159](https://github.com/guanguans/notify/issues/159) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.25
- Merge pull request [#158](https://github.com/guanguans/notify/issues/158) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.24
- Merge pull request [#157](https://github.com/guanguans/notify/issues/157) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.23
- Merge pull request [#156](https://github.com/guanguans/notify/issues/156) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.22
- Merge pull request [#155](https://github.com/guanguans/notify/issues/155) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.20
- Merge pull request [#154](https://github.com/guanguans/notify/issues/154) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.19


<a name="3.2.2"></a>
## [3.2.2] - 2025-03-26
### ✨ Features
- **http-client:** Improve mock method for response handling ([1b0ed6f](https://github.com/guanguans/notify/commit/1b0ed6f))

### 🐞 Bug Fixes
- **doc:** Update method parameter types to 'mixed' in message classes ([ad65b9a](https://github.com/guanguans/notify/commit/ad65b9a))
- **doc:** Update doc comments for HTTP client methods ([e26179b](https://github.com/guanguans/notify/commit/e26179b))
- **response:** Improve JSON handling and add error throwing ([7515182](https://github.com/guanguans/notify/commit/7515182))

### 💅 Code Refactorings
- **utils:** Improve type annotation and streamline code ([b3ef9e8](https://github.com/guanguans/notify/commit/b3ef9e8))

### 🤖 Continuous Integrations
- **workflows:** Add license update workflow ([06772a1](https://github.com/guanguans/notify/commit/06772a1))


<a name="3.2.1"></a>
## [3.2.1] - 2025-03-26
### 🐞 Bug Fixes
- **http-client:** Update error message for argument validation ([b91f4a9](https://github.com/guanguans/notify/commit/b91f4a9))

### 💅 Code Refactorings
- **HasOptions:** Simplify casing functions in __call method ([068d3f5](https://github.com/guanguans/notify/commit/068d3f5))


<a name="3.2.0"></a>
## [3.2.0] - 2025-03-25
### ✨ Features
- **composer:** Update dependencies and remove unused packages ([9710849](https://github.com/guanguans/notify/commit/9710849))

### 🐞 Bug Fixes
- **Response:** Simplify exception handling in throw method ([9f5eb34](https://github.com/guanguans/notify/commit/9f5eb34))
- **Response:** Remove readonly annotations from properties ([e29b932](https://github.com/guanguans/notify/commit/e29b932))
- **ServerChan:** Remove deprecated encryption method ([6d6dc8f](https://github.com/guanguans/notify/commit/6d6dc8f))
- **arr:** add paramOut.type to phpstan.neon ([cc2ebac](https://github.com/guanguans/notify/commit/cc2ebac))
- **baselines:** Remove deprecated method.nonObject baseline ([8bc7f88](https://github.com/guanguans/notify/commit/8bc7f88))
- **baselines:** Remove unused baseline file for argument unpacking ([68fb1a2](https://github.com/guanguans/notify/commit/68fb1a2))
- **baselines:** Improve baseline error handling and add files ([8fb0291](https://github.com/guanguans/notify/commit/8fb0291))
- **composer-updater:** Replace strIs method with Str::is ([d5b3059](https://github.com/guanguans/notify/commit/d5b3059))
- **dependencies:** Ignore errors for specific extensions and packages ([1e57e79](https://github.com/guanguans/notify/commit/1e57e79))
- **phpstan:** Improve strictness of type checking ([44707db](https://github.com/guanguans/notify/commit/44707db))

### ✅ Tests
- **tests:** Improve autoload class retrieval in Pest ([8205f58](https://github.com/guanguans/notify/commit/8205f58))

### 🤖 Continuous Integrations
- **config:** Update PHPStan configuration for type checks ([bd82882](https://github.com/guanguans/notify/commit/bd82882))

### Pull Requests
- Merge pull request [#153](https://github.com/guanguans/notify/issues/153) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.18
- Merge pull request [#152](https://github.com/guanguans/notify/issues/152) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.17


<a name="3.1.2"></a>
## [3.1.2] - 2025-03-12
### 🐞 Bug Fixes
- **Authenticator:** Improve argument validation logic ([9aab998](https://github.com/guanguans/notify/commit/9aab998))

### 🤖 Continuous Integrations
- **config:** Enhance Rector configuration for flexibility ([cb70e0e](https://github.com/guanguans/notify/commit/cb70e0e))
- **dependency:** Add composer dependency analyser configuration ([0562a05](https://github.com/guanguans/notify/commit/0562a05))

### Pull Requests
- Merge pull request [#151](https://github.com/guanguans/notify/issues/151) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.16
- Merge pull request [#150](https://github.com/guanguans/notify/issues/150) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.15


<a name="3.1.1"></a>
## [3.1.1] - 2025-03-04
### 🎨 Styles
- **config:** Improve PHP CS Fixer configuration and order traits ([69abbf4](https://github.com/guanguans/notify/commit/69abbf4))

### 💅 Code Refactorings
- **tests:** Rename directory from fixtures to Fixtures ([e20db3a](https://github.com/guanguans/notify/commit/e20db3a))

### 🤖 Continuous Integrations
- **rector:** Add PHPStan ignore rules to configuration ([4446dfc](https://github.com/guanguans/notify/commit/4446dfc))
- **workflows:** Add coverage file path to Codecov config ([eb033ca](https://github.com/guanguans/notify/commit/eb033ca))

### Pull Requests
- Merge pull request [#149](https://github.com/guanguans/notify/issues/149) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.14
- Merge pull request [#148](https://github.com/guanguans/notify/issues/148) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.13


<a name="3.1.0"></a>
## [3.1.0] - 2025-02-25
### ✨ Features
- **deps:** Update symfony/options-resolver version constraint to support only 6.0 and 7.0 ([104b4ef](https://github.com/guanguans/notify/commit/104b4ef))

### 🐞 Bug Fixes
- **config:** Update PHPStan level and improve typing ([746ab33](https://github.com/guanguans/notify/commit/746ab33))
- **workflows:** Update PHP CS Fixer command in CI configuration ([cae0f1f](https://github.com/guanguans/notify/commit/cae0f1f))

### 🤖 Continuous Integrations
- **baselines:** Add new baseline and update existing files ([9901302](https://github.com/guanguans/notify/commit/9901302))
- **config:** Update dependencies and improve PHPStan configuration ([5f9832a](https://github.com/guanguans/notify/commit/5f9832a))
- **config:** Adjust PHP CS Fixer and remove unused packages ([4f08fd3](https://github.com/guanguans/notify/commit/4f08fd3))
- **dependencies:** Add symplify/phpstan-rules for code quality ([4fa60e1](https://github.com/guanguans/notify/commit/4fa60e1))
- **dependencies:** Add PHPStan baseline and unused method checks ([944851a](https://github.com/guanguans/notify/commit/944851a))


<a name="3.0.2"></a>
## [3.0.2] - 2025-02-24
### 🐞 Bug Fixes
- **configuration:** Add additional rector rules and update paths ([9512c51](https://github.com/guanguans/notify/commit/9512c51))

### 🎨 Styles
- **config:** Refactor license and PHP CS Fixer configuration ([19a2e87](https://github.com/guanguans/notify/commit/19a2e87))
- **config:** Enhance PHP CS Fixer and clean imports ([0cad6f8](https://github.com/guanguans/notify/commit/0cad6f8))

### 💅 Code Refactorings
- **Response:** Simplify exception handling and cleaner code ([fdf5bf2](https://github.com/guanguans/notify/commit/fdf5bf2))
- **Support:** Rename error_silencer to error_handler ([419c33d](https://github.com/guanguans/notify/commit/419c33d))
- **config:** Improve message handling and array functions ([339f9a3](https://github.com/guanguans/notify/commit/339f9a3))

### 🏎 Performance Improvements
- **Response:** Improve type hinting for key parameters ([6919032](https://github.com/guanguans/notify/commit/6919032))
- **doc:** Improve type coverage and doc comments ([37fc5bd](https://github.com/guanguans/notify/commit/37fc5bd))

### ✅ Tests
- update test case templates and improve code quality ([9370761](https://github.com/guanguans/notify/commit/9370761))

### 🤖 Continuous Integrations
- **workflows:** Remove Psalm workflow and configuration files ([ce97407](https://github.com/guanguans/notify/commit/ce97407))


<a name="3.0.1"></a>
## [3.0.1] - 2025-02-23
### 🏎 Performance Improvements
- **Response:** Refactor response methods for type clarity ([5b2a315](https://github.com/guanguans/notify/commit/5b2a315))
- **dependencies:** Add PHPStan extensions and improve type hints ([4fc80db](https://github.com/guanguans/notify/commit/4fc80db))
- **rector:** Remove Deprecated ReturnTypeWillChange Annotations ([6f745b8](https://github.com/guanguans/notify/commit/6f745b8))

### 📦 Builds
- **config:** Update branch alias to 3.x-dev ([53a0a66](https://github.com/guanguans/notify/commit/53a0a66))


<a name="3.0.0"></a>
## [3.0.0] - 2025-02-23
### ✨ Features
- **auth:** Mark sensitive parameters in constructors ([30148c8](https://github.com/guanguans/notify/commit/30148c8))
- **dependencies:** Update composer Git hooks and illuminate versions ([956d7c4](https://github.com/guanguans/notify/commit/956d7c4))
- **workflows:** upgrade PHP version to 8.0 ([441fff0](https://github.com/guanguans/notify/commit/441fff0))

### 💅 Code Refactorings
- Add rector configuration file ([4f0f92c](https://github.com/guanguans/notify/commit/4f0f92c))
- Move cache and build files to .build directory ([4199d84](https://github.com/guanguans/notify/commit/4199d84))
- **support:** Improve function availability checks ([b7d1650](https://github.com/guanguans/notify/commit/b7d1650))

### ✅ Tests
- **composer:** Add phpunit-slow-test-detector dependency ([0201065](https://github.com/guanguans/notify/commit/0201065))
- **config:** Update PHPUnit configuration and dependencies ([5c810e7](https://github.com/guanguans/notify/commit/5c810e7))
- **rector:** Replace usage of Pest Faker functions ([cc6f61c](https://github.com/guanguans/notify/commit/cc6f61c))

### 🤖 Continuous Integrations
- apply rector ([7e15183](https://github.com/guanguans/notify/commit/7e15183))
- apply rector ([ed3fdcc](https://github.com/guanguans/notify/commit/ed3fdcc))
- apply php-cs-fixer ([e397a83](https://github.com/guanguans/notify/commit/e397a83))
- **config:** Update infection command and json configuration ([4188b6d](https://github.com/guanguans/notify/commit/4188b6d))
- **dependencies:** Remove unused packages and add new ones ([afdc33d](https://github.com/guanguans/notify/commit/afdc33d))
- **editorconfig:** Update indentation settings ([5f4e038](https://github.com/guanguans/notify/commit/5f4e038))
- **rector:** Refactor autoload function handling in configuration ([81656ea](https://github.com/guanguans/notify/commit/81656ea))


<a name="2.14.1"></a>
## [2.14.1] - 2025-02-22
### 🤖 Continuous Integrations
- **composer-updater:** Add additional options to process command ([b079389](https://github.com/guanguans/notify/commit/b079389))
- **github:** Update PHP version in workflows and composer ([7c74ba3](https://github.com/guanguans/notify/commit/7c74ba3))
- **scope:** Update composer.json and add ractor-php82 ([9c1c7c3](https://github.com/guanguans/notify/commit/9c1c7c3))

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
### ✨ Features
- **Authenticators:** Add `reversed` option to OptionsAuthenticator ([ae2085d](https://github.com/guanguans/notify/commit/ae2085d))
- **PushMe:** adds PushMe package ([0c14d8b](https://github.com/guanguans/notify/commit/0c14d8b))


<a name="2.13.1"></a>
## [2.13.1] - 2025-01-13
### 💅 Code Refactorings
- **Response:** Refactor is() method ([b2fa246](https://github.com/guanguans/notify/commit/b2fa246))

### Pull Requests
- Merge pull request [#136](https://github.com/guanguans/notify/issues/136) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.88.2


<a name="2.13.0"></a>
## [2.13.0] - 2025-01-09
### ✨ Features
- **response:** Add fluent method for JSON response handling ([8b3ade0](https://github.com/guanguans/notify/commit/8b3ade0))

### 📦 Builds
- **dependencies:** Update development dependencies versions ([661c33c](https://github.com/guanguans/notify/commit/661c33c))

### 🤖 Continuous Integrations
- **config:** Update PHPStan baseline and error configurations ([18707e6](https://github.com/guanguans/notify/commit/18707e6))
- **core:** Update copyright year to 2025 ([6b94d07](https://github.com/guanguans/notify/commit/6b94d07))
- **workflows:** Add PHP 8.4 to test matrix ([67e71b2](https://github.com/guanguans/notify/commit/67e71b2))

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
### ✨ Features
- **Response:** Add rawStream method for temporary resources ([e3ded5b](https://github.com/guanguans/notify/commit/e3ded5b))
- **Response:** Add stream method to retrieve body as stream ([963c535](https://github.com/guanguans/notify/commit/963c535))

### 🏎 Performance Improvements
- **Response:** Improve documentation for collect method ([adf3007](https://github.com/guanguans/notify/commit/adf3007))

### ✅ Tests
- **Response:** Refactor saveAs method and add new test case ([82055ed](https://github.com/guanguans/notify/commit/82055ed))


<a name="2.12.3"></a>
## [2.12.3] - 2024-11-14
### ✨ Features
- **response:** Add resource method to retrieve response body ([27d2b2f](https://github.com/guanguans/notify/commit/27d2b2f))

### 📖 Documents
- **README:** Add blank line for Markdown formatting ([ebc5e80](https://github.com/guanguans/notify/commit/ebc5e80))
- **readme:** Add example for DingTalk client usage ([54e80bc](https://github.com/guanguans/notify/commit/54e80bc))

### 📦 Builds
- **dependencies:** Update phpstan versions and ai-commit commands ([dc19bd6](https://github.com/guanguans/notify/commit/dc19bd6))

### 🤖 Continuous Integrations
- **chglog:** Update configuration for commit types ([aedbef8](https://github.com/guanguans/notify/commit/aedbef8))

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
### ✨ Features
- **Authenticator:** update base URI construction logic ([550a497](https://github.com/guanguans/notify/commit/550a497))
- **Message:** add tags method and property ([709dbd3](https://github.com/guanguans/notify/commit/709dbd3))
- **rector:** add sensitive parameter attribute rector ([d4c0dfc](https://github.com/guanguans/notify/commit/d4c0dfc))

### 📖 Documents
- **README:** Improve HandlerStackResolver example ([b9c6938](https://github.com/guanguans/notify/commit/b9c6938))
- **README:** Update client handler setup instructions ([6bc0b36](https://github.com/guanguans/notify/commit/6bc0b36))

### 💅 Code Refactorings
- **ServerChan:** refactor Authenticator and Message classes ([47043be](https://github.com/guanguans/notify/commit/47043be))

### ✅ Tests
- **ServerChan:** refactor message sending test to use dynamic key ([c1adf79](https://github.com/guanguans/notify/commit/c1adf79))

### Pull Requests
- Merge pull request [#109](https://github.com/guanguans/notify/issues/109) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.6
- Merge pull request [#108](https://github.com/guanguans/notify/issues/108) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.5
- Merge pull request [#107](https://github.com/guanguans/notify/issues/107) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.3
- Merge pull request [#105](https://github.com/guanguans/notify/issues/105) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.2
- Merge pull request [#104](https://github.com/guanguans/notify/issues/104) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.82.1


<a name="2.12.1"></a>
## [2.12.1] - 2024-09-09
### ✨ Features
- **http-client:** add default middleware method ([d27d82f](https://github.com/guanguans/notify/commit/d27d82f))

### 📖 Documents
- **readme:** update middleware usage in client handler ([6493bba](https://github.com/guanguans/notify/commit/6493bba))

### 💅 Code Refactorings
- **http-client:** rename method and streamline middleware handling ([f3a518c](https://github.com/guanguans/notify/commit/f3a518c))
- **http-client:** simplify http client resolver logic ([3fc69af](https://github.com/guanguans/notify/commit/3fc69af))


<a name="2.12.0"></a>
## [2.12.0] - 2024-09-09
### ✨ Features
- **Client:** add getter and setter for authenticator ([ad23501](https://github.com/guanguans/notify/commit/ad23501))
- **http-client:** add handler stack resolver methods ([13e0e91](https://github.com/guanguans/notify/commit/13e0e91))
- **rector:** add ChangeMethodVisibilityRector configuration ([e38428d](https://github.com/guanguans/notify/commit/e38428d))

### 📖 Documents
- **http-client:** Update type hints for resolvers ([edc7e56](https://github.com/guanguans/notify/commit/edc7e56))
- **readme:** add coroutine handler example ([4fa7398](https://github.com/guanguans/notify/commit/4fa7398))

### 💅 Code Refactorings
- **http:** Add handlerStackResolver to Client ([c032eda](https://github.com/guanguans/notify/commit/c032eda))

### ✅ Tests
- **client:** add tests for setting authenticator and handler stack resolver ([8195dde](https://github.com/guanguans/notify/commit/8195dde))

### Pull Requests
- Merge pull request [#103](https://github.com/guanguans/notify/issues/103) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.81.10


<a name="2.11.10"></a>
## [2.11.10] - 2024-08-21
### 💅 Code Refactorings
- **messages:** rename toHttpOptions to toPayload ([c529f8b](https://github.com/guanguans/notify/commit/c529f8b))

### ✅ Tests
- **HasOptions:** add validation checks for options ([62eca7a](https://github.com/guanguans/notify/commit/62eca7a))


<a name="2.11.9"></a>
## [2.11.9] - 2024-08-16
### 📖 Documents
- **README:** Add JetBrains logo and link ([dcb734a](https://github.com/guanguans/notify/commit/dcb734a))

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
### 🎨 Styles
- **generate-ide-json:** improve readability of filter and pipe functions ([e63d4f2](https://github.com/guanguans/notify/commit/e63d4f2))

### 🏎 Performance Improvements
- **src:** improve performance by using const instead of define ([2c09892](https://github.com/guanguans/notify/commit/2c09892))


<a name="2.11.7"></a>
## [2.11.7] - 2024-07-19
### ✨ Features
- **generate-ide-json:** add script to generate ide.json for PHP IDE assistance ([cce9acb](https://github.com/guanguans/notify/commit/cce9acb))
- **ide:** Add completions for staticStrings and classFields ([7c66b1c](https://github.com/guanguans/notify/commit/7c66b1c))

### 📖 Documents
- Add completion.jpg image ([a1690b6](https://github.com/guanguans/notify/commit/a1690b6))
- **ServerChan:** update links in README ([43cc9f1](https://github.com/guanguans/notify/commit/43cc9f1))

### 📦 Builds
- **deps:** update guzzlehttp/guzzle version ([16e142e](https://github.com/guanguans/notify/commit/16e142e))

### Pull Requests
- Merge pull request [#92](https://github.com/guanguans/notify/issues/92) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.80.1
- Merge pull request [#90](https://github.com/guanguans/notify/issues/90) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.80.0


<a name="2.11.6"></a>
## [2.11.6] - 2024-07-16
### 📖 Documents
- **benchmark:** update benchmark results ([04d0380](https://github.com/guanguans/notify/commit/04d0380))

### ✅ Tests
- **benchmarks:** rename NotifyBench.php to SendMessageBench.php ([6ebfde1](https://github.com/guanguans/notify/commit/6ebfde1))


<a name="2.11.5"></a>
## [2.11.5] - 2024-07-16
### 📖 Documents
- **benchmark:** Add benchmarking command to README.md ([a480b72](https://github.com/guanguans/notify/commit/a480b72))

### ✅ Tests
- Update benchmark command in composer.json ([0c1f186](https://github.com/guanguans/notify/commit/0c1f186))
- Add phpbench for benchmarking ([5f7bc42](https://github.com/guanguans/notify/commit/5f7bc42))


<a name="2.11.4"></a>
## [2.11.4] - 2024-07-10
### ✨ Features
- **Utils:** add normalizeHttpOptions method ([906d848](https://github.com/guanguans/notify/commit/906d848))

### 💅 Code Refactorings
- **utils:** update Utils references ([928d8d1](https://github.com/guanguans/notify/commit/928d8d1))


<a name="2.11.3"></a>
## [2.11.3] - 2024-07-09
### 🏎 Performance Improvements
- **src:** improve performance of Client pool method ([8e94cea](https://github.com/guanguans/notify/commit/8e94cea))


<a name="2.11.2"></a>
## [2.11.2] - 2024-07-09
### 📖 Documents
- **Client:** Add link to Guzzle documentation ([a90b28e](https://github.com/guanguans/notify/commit/a90b28e))

### 🤖 Continuous Integrations
- **psalm:** update psalm baseline ([9ab7900](https://github.com/guanguans/notify/commit/9ab7900))


<a name="2.11.1"></a>
## [2.11.1] - 2024-07-09
### 📖 Documents
- **docs:** add additional code examples to README.md ([c6e2930](https://github.com/guanguans/notify/commit/c6e2930))
- **types:** Update PHPDoc comments for type hints in Client class ([0d3ab6a](https://github.com/guanguans/notify/commit/0d3ab6a))

### ✅ Tests
- **test:** add test for concurrent message sending ([9492bb4](https://github.com/guanguans/notify/commit/9492bb4))


<a name="2.11.0"></a>
## [2.11.0] - 2024-07-09
### ✨ Features
- **Client:** add pool method to handle multiple messages asynchronously ([18813fe](https://github.com/guanguans/notify/commit/18813fe))
- **Client:** add asynchronous message sending capability ([af825f5](https://github.com/guanguans/notify/commit/af825f5))

### 🤖 Continuous Integrations
- **composer-require-checker:** Add GuzzleHttp PromiseInterface and Utils ([3803d28](https://github.com/guanguans/notify/commit/3803d28))


<a name="2.10.0"></a>
## [2.10.0] - 2024-07-09
### 💅 Code Refactorings
- **messages:** refactor postFor method in PostMessage class ([4aa5603](https://github.com/guanguans/notify/commit/4aa5603))
- **tests:** refactor create_response to response ([96c3387](https://github.com/guanguans/notify/commit/96c3387))


<a name="2.9.0"></a>
## [2.9.0] - 2024-07-08
### ✨ Features
- **authenticators:** improve constructor parameter formatting ([c6671e7](https://github.com/guanguans/notify/commit/c6671e7))

### 📦 Builds
- **composer.json:** update dependencies versions ([5603009](https://github.com/guanguans/notify/commit/5603009))

### 🤖 Continuous Integrations
- **release:** update rector.php configuration ([4d0c8c6](https://github.com/guanguans/notify/commit/4d0c8c6))

### Pull Requests
- Merge pull request [#89](https://github.com/guanguans/notify/issues/89) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.2.0
- Merge pull request [#88](https://github.com/guanguans/notify/issues/88) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.79.0
- Merge pull request [#87](https://github.com/guanguans/notify/issues/87) from guanguans/dependabot/composer/brainmaestro/composer-git-hooks-tw-2.8or-tw-3.0
- Merge pull request [#86](https://github.com/guanguans/notify/issues/86) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.78.2


<a name="2.8.4"></a>
## [2.8.4] - 2024-06-14
### 🐞 Bug Fixes
- **Support:** Fix undefined constant issue ([87368a6](https://github.com/guanguans/notify/commit/87368a6))

### ✅ Tests
- **test:** add tests for form params, query, and Multipart conversion ([bf9a95c](https://github.com/guanguans/notify/commit/bf9a95c))

### 🤖 Continuous Integrations
- **psalm:** Update psalm baseline and remove unused closure param ([2586a77](https://github.com/guanguans/notify/commit/2586a77))


<a name="2.8.3"></a>
## [2.8.3] - 2024-06-14
### ✨ Features
- **Message:** Add new methods to handle form parameters, query strings, and multipart data ([e7c2a7c](https://github.com/guanguans/notify/commit/e7c2a7c))

### 🤖 Continuous Integrations
- **composer.json:** Add pest-highest and putenvs scripts ([48c4510](https://github.com/guanguans/notify/commit/48c4510))


<a name="2.8.2"></a>
## [2.8.2] - 2024-06-13
### 🐞 Bug Fixes
- **HasOptions:** Fix offsetGet method ([ea00174](https://github.com/guanguans/notify/commit/ea00174))


<a name="2.8.1"></a>
## [2.8.1] - 2024-06-13
### 📦 Builds
- **php-cs-fixer:** Add parallel config support ([d2daade](https://github.com/guanguans/notify/commit/d2daade))

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
### ✨ Features
- **WPush:** Add WPush package with Authenticator, Client, Message classes and README.md file ([961a57e](https://github.com/guanguans/notify/commit/961a57e))
- **tests:** add ClientTest for WPush ([9f0ec59](https://github.com/guanguans/notify/commit/9f0ec59))


<a name="2.7.0"></a>
## [2.7.0] - 2024-05-10
### ✨ Features
- **AnPush:** add ClientTest.php for sending message ([486af99](https://github.com/guanguans/notify/commit/486af99))
- **AnPush:** Add AnPush Authenticator, Client, and Message classes ([b184e4d](https://github.com/guanguans/notify/commit/b184e4d))

### 📖 Documents
- **readme:** update push notification SDK list ([8a5e378](https://github.com/guanguans/notify/commit/8a5e378))


<a name="2.6.1"></a>
## [2.6.1] - 2024-05-09
### Pull Requests
- Merge pull request [#77](https://github.com/guanguans/notify/issues/77) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.75.1
- Merge pull request [#76](https://github.com/guanguans/notify/issues/76) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.75.0
- Merge pull request [#75](https://github.com/guanguans/notify/issues/75) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.1.0
- Merge pull request [#74](https://github.com/guanguans/notify/issues/74) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.74.0


<a name="2.6.0"></a>
## [2.6.0] - 2024-04-22
### ✅ Tests
- Add tests for getting headers and reason in Response class ([03d350f](https://github.com/guanguans/notify/commit/03d350f))

### Pull Requests
- Merge pull request [#72](https://github.com/guanguans/notify/issues/72) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.73.0
- Merge pull request [#71](https://github.com/guanguans/notify/issues/71) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.72.0
- Merge pull request [#70](https://github.com/guanguans/notify/issues/70) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.71.2
- Merge pull request [#69](https://github.com/guanguans/notify/issues/69) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.71.1
- Merge pull request [#68](https://github.com/guanguans/notify/issues/68) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.71.0


<a name="2.5.1"></a>
## [2.5.1] - 2024-03-22
### 💅 Code Refactorings
- **Response:** improve request and response summary handling ([9593081](https://github.com/guanguans/notify/commit/9593081))

### Pull Requests
- Merge pull request [#67](https://github.com/guanguans/notify/issues/67) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.0.0
- Merge pull request [#66](https://github.com/guanguans/notify/issues/66) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.70.3


<a name="2.5.0"></a>
## [2.5.0] - 2024-03-20
### ✨ Features
- **SimplePush:** Add SimplePush package with Authenticator, Client, and Messages ([84ff9c1](https://github.com/guanguans/notify/commit/84ff9c1))

### ✅ Tests
- **SimplePush:** add test case for sending message ([967e2c4](https://github.com/guanguans/notify/commit/967e2c4))


<a name="2.4.3"></a>
## [2.4.3] - 2024-03-20
### Pull Requests
- Merge pull request [#65](https://github.com/guanguans/notify/issues/65) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.70.2
- Merge pull request [#64](https://github.com/guanguans/notify/issues/64) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.70.0


<a name="2.4.2"></a>
## [2.4.2] - 2024-03-12
### 📖 Documents
- **readme:** Add list of supported Push notification SDKs ([626c1ce](https://github.com/guanguans/notify/commit/626c1ce))

### 🎨 Styles
- **.php-cs-fixer:** improve code style and remove redundant rules ([55afb22](https://github.com/guanguans/notify/commit/55afb22))
- **.php-cs-fixer.php:** update coding style rules ([92733e0](https://github.com/guanguans/notify/commit/92733e0))

### 💅 Code Refactorings
- **utils:** Improve property retrieval in Utils class ([8d0dd58](https://github.com/guanguans/notify/commit/8d0dd58))
- **utils:** improve handling of properties in Utils class ([76967fe](https://github.com/guanguans/notify/commit/76967fe))

### 🤖 Continuous Integrations
- apply php-cs-fixer ([21880dc](https://github.com/guanguans/notify/commit/21880dc))


<a name="2.4.1"></a>
## [2.4.1] - 2024-03-11
### ✨ Features
- **Utils:** Add method to get defined properties for an object ([4ec19ac](https://github.com/guanguans/notify/commit/4ec19ac))

### 📖 Documents
- Update push notification SDK list in README ([2aa5c29](https://github.com/guanguans/notify/commit/2aa5c29))

### 💅 Code Refactorings
- **HasOptions:** Improve preConfigureOptionsResolver method ([c9aaef3](https://github.com/guanguans/notify/commit/c9aaef3))
- **platform-lint:** Update platform handling and documentation ([47f92ae](https://github.com/guanguans/notify/commit/47f92ae))
- **tests:** Improve HasOptionsTest.php test coverage ([fb0f9a8](https://github.com/guanguans/notify/commit/fb0f9a8))
- **utils:** Use Utils::definedFor() method in HasOptions ([ea096c7](https://github.com/guanguans/notify/commit/ea096c7))


<a name="2.4.0"></a>
## [2.4.0] - 2024-03-10
### ✨ Features
- **helper:** add error_silencer function ([84af72f](https://github.com/guanguans/notify/commit/84af72f))
- **src:** Add Method interface and related RFCs ([49e7e7f](https://github.com/guanguans/notify/commit/49e7e7f))
- **tests:** add Faker trait for generating fake data ([69b0edc](https://github.com/guanguans/notify/commit/69b0edc))

### 💅 Code Refactorings
- improve StringToClassConstantRector ([b386868](https://github.com/guanguans/notify/commit/b386868))
- **rector:** Update namespace for rector classes ([56e2f4c](https://github.com/guanguans/notify/commit/56e2f4c))
- **utils:** Rename getHttpOptionsConstants to httpOptionConstants ([e9bce95](https://github.com/guanguans/notify/commit/e9bce95))
- **utils:** improve user agent method ([2d5d77d](https://github.com/guanguans/notify/commit/2d5d77d))
- **utils:** Improve clarity and consistency in multipartFor method ([ae302fe](https://github.com/guanguans/notify/commit/ae302fe))

### 🤖 Continuous Integrations
- apply php-cs-fixer ([772b616](https://github.com/guanguans/notify/commit/772b616))

### Pull Requests
- Merge pull request [#61](https://github.com/guanguans/notify/issues/61) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.69.0


<a name="2.3.1"></a>
## [2.3.1] - 2024-03-08
### ✨ Features
- **Utils:** Add userAgent method to generate user agent string ([95efb1d](https://github.com/guanguans/notify/commit/95efb1d))
- **httpclient:** Add User-Agent header to HTTP requests ([404224f](https://github.com/guanguans/notify/commit/404224f))

### 💅 Code Refactorings
- **Authenticator:** improve constructor logic ([313ba07](https://github.com/guanguans/notify/commit/313ba07))
- **HasHttpClient:** adjust multipart options handling ([f2353ea](https://github.com/guanguans/notify/commit/f2353ea))
- **HasHttpClient:** Improve HTTP client options handling ([20d4f7c](https://github.com/guanguans/notify/commit/20d4f7c))
- **Utils:** improve multipartFor method ([57dcf59](https://github.com/guanguans/notify/commit/57dcf59))
- **Utils:** Improve handling of contents in Utils class ([2dae640](https://github.com/guanguans/notify/commit/2dae640))

### ✅ Tests
- **AuthenticatorTest:** add tests for Authenticator class ([654134f](https://github.com/guanguans/notify/commit/654134f))


<a name="2.3.0"></a>
## [2.3.0] - 2024-03-08
### ✨ Features
- **pushbullet:** add PushBullet integration ([369c3f9](https://github.com/guanguans/notify/commit/369c3f9))

### ✅ Tests
- **PushBullet:** add test for sending message functionality ([783c76f](https://github.com/guanguans/notify/commit/783c76f))

### Pull Requests
- Merge pull request [#60](https://github.com/guanguans/notify/issues/60) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.68.5


<a name="2.2.1"></a>
## [2.2.1] - 2024-03-07
### ✨ Features
- **Str:** Add kebab case conversion method ([355d824](https://github.com/guanguans/notify/commit/355d824))
- **php:** Add StringToClassConstantRector for GuzzleHttp RequestOptions ([5d849e9](https://github.com/guanguans/notify/commit/5d849e9))
- **platform-lint:** Add platform-lint script for linting platforms ([52ad141](https://github.com/guanguans/notify/commit/52ad141))
- **tests:** add new test files for Foundation ([d415cd5](https://github.com/guanguans/notify/commit/d415cd5))

### 📖 Documents
- **README:** Update baseUri parameter in code comments ([96f493b](https://github.com/guanguans/notify/commit/96f493b))

### 💅 Code Refactorings
- **Message:** Improve JSON serialization method ([4de14b9](https://github.com/guanguans/notify/commit/4de14b9))
- **auth:** Improve CompactToVariablesRector ([cb4bbf8](https://github.com/guanguans/notify/commit/cb4bbf8))
- **debug:** Use mergeDebugInfo instead of withDebugInfo ([3613797](https://github.com/guanguans/notify/commit/3613797))
- **http:** Normalize HTTP options handling ([c7ae5d6](https://github.com/guanguans/notify/commit/c7ae5d6))
- **options:** Improve options handling and validation ([7ef13b2](https://github.com/guanguans/notify/commit/7ef13b2))
- **uri:** improve UriTemplateAuthenticator applyToRequest method ([a866bfd](https://github.com/guanguans/notify/commit/a866bfd))

### ✅ Tests
- **MessageTest:** add validation for options ([f97f370](https://github.com/guanguans/notify/commit/f97f370))


<a name="2.2.0"></a>
## [2.2.0] - 2024-03-06
### ✨ Features
- **Client:** Add __debugInfo method for debugging ([0d9ab74](https://github.com/guanguans/notify/commit/0d9ab74))
- **HasHttpClient:** Add ability to set HttpClientResolver ([febef60](https://github.com/guanguans/notify/commit/febef60))
- **tests:** add AsNullUri to Message class and update PostMessage structure ([18757db](https://github.com/guanguans/notify/commit/18757db))

### 💅 Code Refactorings
- **AsBody:** improve handling of message body serialization ([5854bb5](https://github.com/guanguans/notify/commit/5854bb5))
- **HasHttpClient:** configure HTTP options in getHttpClient method ([65f449d](https://github.com/guanguans/notify/commit/65f449d))
- **HasOptions:** Improve options handling ([4983a44](https://github.com/guanguans/notify/commit/4983a44))
- **core:** Update toPayload method in Message classes ([f5ef55c](https://github.com/guanguans/notify/commit/f5ef55c))
- **core:** Improve payload handling in HTTP request options ([4e203a3](https://github.com/guanguans/notify/commit/4e203a3))
- **http:** improve HTTP client configuration ([87ce562](https://github.com/guanguans/notify/commit/87ce562))
- **rectors:** Move rector classes to appropriate namespace ([7458311](https://github.com/guanguans/notify/commit/7458311))


<a name="2.1.2"></a>
## [2.1.2] - 2024-03-05
### ✨ Features
- **NewsMessage:** add method to configure options for articles ([a3b4c80](https://github.com/guanguans/notify/commit/a3b4c80))
- **auth:** add OptionsAuthenticator and mergeHttpOptions method ([5ab73f6](https://github.com/guanguans/notify/commit/5ab73f6))

### 💅 Code Refactorings
- Remove unnecessary trait use in rector.php ([a567a5c](https://github.com/guanguans/notify/commit/a567a5c))
- **HasOptionsDocCommentRector:** Sort properties in alphabetical order ([56a2b68](https://github.com/guanguans/notify/commit/56a2b68))
- **Message:** Improve attachment handling in Message class ([4d8a4c4](https://github.com/guanguans/notify/commit/4d8a4c4))
- **Message:** improve default options handling ([be47017](https://github.com/guanguans/notify/commit/be47017))
- **Message:** Improve addAction method and configureOptionsResolver ([34e7536](https://github.com/guanguans/notify/commit/34e7536))
- **Message:** Improve embed configuration handling ([5b5dc3f](https://github.com/guanguans/notify/commit/5b5dc3f))
- **commit:** refactor configureAndResolveOptions method ([4625cd8](https://github.com/guanguans/notify/commit/4625cd8))
- **core:** update HTTP method definitions ([bd3e39d](https://github.com/guanguans/notify/commit/bd3e39d))
- **message:** Refactor message classes for NowPush ([6bb946e](https://github.com/guanguans/notify/commit/6bb946e))
- **message:** Improve section and potential action handling ([54cf199](https://github.com/guanguans/notify/commit/54cf199))
- **postmessage:** Improve language-specific post setting ([df13219](https://github.com/guanguans/notify/commit/df13219))

### Pull Requests
- Merge pull request [#59](https://github.com/guanguans/notify/issues/59) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.68.4


<a name="2.1.1"></a>
## [2.1.1] - 2024-03-04
### ✨ Features
- **Telegram:** Add support for multipart requests in Telegram messages ([2442282](https://github.com/guanguans/notify/commit/2442282))
- **dingtalk:** add DingTalk notification support ([3809b6d](https://github.com/guanguans/notify/commit/3809b6d))
- **extract-platform:** add script to extract platform information ([8340ca6](https://github.com/guanguans/notify/commit/8340ca6))
- **messages:** Add toHttpUri method for sending various message types ([c4dd5c3](https://github.com/guanguans/notify/commit/c4dd5c3))
- **telegram:** Add AsJson trait to GetUpdatesMessage and ClientTest ([19af453](https://github.com/guanguans/notify/commit/19af453))
- **telegram:** Add constructor to Client class ([15d6a3e](https://github.com/guanguans/notify/commit/15d6a3e))

### 📖 Documents
- Update push notification SDK list ([646b083](https://github.com/guanguans/notify/commit/646b083))

### 💅 Code Refactorings
- **client:** Remove Makeable trait from Client class ([36fefe5](https://github.com/guanguans/notify/commit/36fefe5))
- **media:** Improve media handling in MediaGroupMessage ([e17b4a3](https://github.com/guanguans/notify/commit/e17b4a3))
- **message:** Improve make method in Message class ([d50eddb](https://github.com/guanguans/notify/commit/d50eddb))
- **pushplus:** Rename Pushplus to PushPlus and update namespaces ([35c25c4](https://github.com/guanguans/notify/commit/35c25c4))


<a name="2.1.0"></a>
## [2.1.0] - 2024-03-03
### ✨ Features
- **PushDeer:** Add PushDeer service with related classes ([a531f8f](https://github.com/guanguans/notify/commit/a531f8f))

### 💅 Code Refactorings
- **tests:** improve assertCanSendMessage method ([5d799da](https://github.com/guanguans/notify/commit/5d799da))


<a name="2.0.6"></a>
## [2.0.6] - 2024-03-02
### ✨ Features
- **Message:** add delayMilliseconds and url methods ([8209583](https://github.com/guanguans/notify/commit/8209583))
- **Slack:** Add metadata to Message options ([1f2e4bb](https://github.com/guanguans/notify/commit/1f2e4bb))
- **Zulip:** add Message class with message creation methods ([d5ffe1c](https://github.com/guanguans/notify/commit/d5ffe1c))
- **messages:** add type, date, and time properties ([a0cb5b0](https://github.com/guanguans/notify/commit/a0cb5b0))
- **messages:** Add support for FileMessage and TemplateCardMessage ([ae89957](https://github.com/guanguans/notify/commit/ae89957))

### 💅 Code Refactorings
- **Message:** Remove redundant array definition ([8ea5d49](https://github.com/guanguans/notify/commit/8ea5d49))
- **TemplateCardMessage:** optimize options configuration ([65f203a](https://github.com/guanguans/notify/commit/65f203a))
- **message:** Update message classes structure ([061c100](https://github.com/guanguans/notify/commit/061c100))


<a name="2.0.5"></a>
## [2.0.5] - 2024-03-02
### ✨ Features
- **Message:** Add channel, webhook, callbackUrl, and timestamp properties to Message class ([0dfd94a](https://github.com/guanguans/notify/commit/0dfd94a))
- **QQ:** add constructor to Client class ([baaed7a](https://github.com/guanguans/notify/commit/baaed7a))
- **RocketChat:** Add message sending functionality with attachments ([f95b269](https://github.com/guanguans/notify/commit/f95b269))

### 📖 Documents
- **ShowdocPush:** Update ShowdocPush documentation ([b03d3b4](https://github.com/guanguans/notify/commit/b03d3b4))
- **slack:** Update Slack Message class methods and properties ([3dcb658](https://github.com/guanguans/notify/commit/3dcb658))

### ✅ Tests
- **ClientTest:** Add new message fields ([c6afe03](https://github.com/guanguans/notify/commit/c6afe03))
- **ClientTest:** refactor message creation in ClientTest ([797976c](https://github.com/guanguans/notify/commit/797976c))
- **ClientTest:** Add attachment and device to message ([b6da8e9](https://github.com/guanguans/notify/commit/b6da8e9))


<a name="2.0.4"></a>
## [2.0.4] - 2024-03-01
### ✨ Features
- **Push:** add support for different message types ([0c08c37](https://github.com/guanguans/notify/commit/0c08c37))

### 💅 Code Refactorings
- **Response:** Improve handling of decoded JSON response ([fff5689](https://github.com/guanguans/notify/commit/fff5689))
- **httpclient:** optimize setting http options ([a2b0077](https://github.com/guanguans/notify/commit/a2b0077))
- **messages:** Update message classes with new traits and methods ([811ce46](https://github.com/guanguans/notify/commit/811ce46))
- **push:** Update Authenticator to use AggregateAuthenticator and PayloadAuthenticator ([610804d](https://github.com/guanguans/notify/commit/610804d))
- **pushback:** Remove commented out code and update URLs in README ([f8405b4](https://github.com/guanguans/notify/commit/f8405b4))

### ✅ Tests
- **ClientTest:** update message sending feature ([c465b08](https://github.com/guanguans/notify/commit/c465b08))


<a name="2.0.3"></a>
## [2.0.3] - 2024-02-29
### ✨ Features
- **GoogleChat:** Add compact payload creation in Authenticator ([c035c2e](https://github.com/guanguans/notify/commit/c035c2e))
- **IGot:** Add title, url, copy, and detail to message ([d4067a3](https://github.com/guanguans/notify/commit/d4067a3))
- **Message:** Add support for [@type](https://github.com/type) and [@context](https://github.com/context) in Message ([28765fe](https://github.com/guanguans/notify/commit/28765fe))
- **MicrosoftTeams:** Add test for sending message ([4a89348](https://github.com/guanguans/notify/commit/4a89348))

### 📖 Documents
- **readme:** update Gitter links and remove Gitter from phpunit.xml.dist ([68ec41d](https://github.com/guanguans/notify/commit/68ec41d))

### 💅 Code Refactorings
- **ClientTest:** Refactor test cases for sending messages ([ca0fe9a](https://github.com/guanguans/notify/commit/ca0fe9a))
- **Message:** Remove base_uri usage and update toHttpUri method ([f051f38](https://github.com/guanguans/notify/commit/f051f38))
- **Message:** Improve Message class structure ([16b6e44](https://github.com/guanguans/notify/commit/16b6e44))
- **Message:** Optimize 'toHttpOptions' method ([927558e](https://github.com/guanguans/notify/commit/927558e))
- **arr:** Improve array handling in Arr class ([a2e1957](https://github.com/guanguans/notify/commit/a2e1957))
- **messages:** Improve array filtering in Message class ([3e10114](https://github.com/guanguans/notify/commit/3e10114))
- **tests:** improve custom expectation function naming ([b12edc0](https://github.com/guanguans/notify/commit/b12edc0))
- **types:** Update type declarations to bool in message classes ([2f4a786](https://github.com/guanguans/notify/commit/2f4a786))

### ✅ Tests
- Add Mattermost ClientTest and update Message.php ([52705f5](https://github.com/guanguans/notify/commit/52705f5))
- Add Gitter and GoogleChat ClientTest files ([db08d54](https://github.com/guanguans/notify/commit/db08d54))

### Pull Requests
- Merge pull request [#58](https://github.com/guanguans/notify/issues/58) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.68.3


<a name="2.0.2"></a>
## [2.0.2] - 2024-02-28
### ✨ Features
- **Chanify:** add support for audio, file, and image messages ([213e0e1](https://github.com/guanguans/notify/commit/213e0e1))
- **Discord:** Add ability to send messages with rich content ([72e5119](https://github.com/guanguans/notify/commit/72e5119))
- **Pest:** add assertCanSendMessage expectation ([b7bc90b](https://github.com/guanguans/notify/commit/b7bc90b))

### 💅 Code Refactorings
- **Message:** update message class properties and methods ([a111bf5](https://github.com/guanguans/notify/commit/a111bf5))
- **MockHandler:** Remove unnecessary code and improve readability ([589c78f](https://github.com/guanguans/notify/commit/589c78f))
- **tests:** Update ClientTest.php for message sending functionality ([c1a5639](https://github.com/guanguans/notify/commit/c1a5639))

### ✅ Tests
- **ClientTest:** Refactor message creation in ClientTest ([f42b584](https://github.com/guanguans/notify/commit/f42b584))


<a name="2.0.1"></a>
## [2.0.1] - 2024-02-27
### ✨ Features
- **notifications:** Add Bark notification support ([6cf2729](https://github.com/guanguans/notify/commit/6cf2729))
- **options:** Add support for ignoreUndefined property ([de7a2cd](https://github.com/guanguans/notify/commit/de7a2cd))
- **support:** Improve array handling in HasHttpClient ([cefee44](https://github.com/guanguans/notify/commit/cefee44))

### 📖 Documents
- Add README.md files for various messaging platforms ([429b271](https://github.com/guanguans/notify/commit/429b271))
- **HasOptions:** Add support for nested options ([a62cb96](https://github.com/guanguans/notify/commit/a62cb96))

### 💅 Code Refactorings
- **HasOptions:** Improve handling of defined and required options ([e7217d5](https://github.com/guanguans/notify/commit/e7217d5))
- **HasOptions:** update deprecated options handling ([d3e8b3c](https://github.com/guanguans/notify/commit/d3e8b3c))
- **tests:** rename wsse authenticator test file and add certificate authenticator test ([4105b65](https://github.com/guanguans/notify/commit/4105b65))

### ✅ Tests
- Add unit tests for Client and Message classes ([b09b0cf](https://github.com/guanguans/notify/commit/b09b0cf))
- add CertificateAuthenticatorTest and WsseAuthenticatorTest ([6e5b0ba](https://github.com/guanguans/notify/commit/6e5b0ba))

### Pull Requests
- Merge pull request [#57](https://github.com/guanguans/notify/issues/57) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.68.2


<a name="2.0.0"></a>
## [2.0.0] - 2024-02-26
### ✨ Features
- **Message:** Add __debugInfo method ([1536490](https://github.com/guanguans/notify/commit/1536490))
- **Utils:** Add objectWithDebugInfo method ([2c8da25](https://github.com/guanguans/notify/commit/2c8da25))

### 💅 Code Refactorings
- **concerns:** Update mixin references in traits ([f362462](https://github.com/guanguans/notify/commit/f362462))
- **debug:** Improve debug info handling ([0e19bb8](https://github.com/guanguans/notify/commit/0e19bb8))


<a name="2.0.0-rc1"></a>
## [2.0.0-rc1] - 2024-02-23
### ✨ Features
- **composer:** add illuminate/collections dependency ([96397a0](https://github.com/guanguans/notify/commit/96397a0))

### 💅 Code Refactorings
- **HasOptions:** Remove resolveOptions method and update getOption method ([abb709b](https://github.com/guanguans/notify/commit/abb709b))
- **Response:** improve response class structure and add new methods ([eaa0662](https://github.com/guanguans/notify/commit/eaa0662))
- **http:** Ensure required middleware in HasHttpClient trait ([5a4a1e6](https://github.com/guanguans/notify/commit/5a4a1e6))
- **utils:** Rename method to more descriptive name ([977c6df](https://github.com/guanguans/notify/commit/977c6df))


<a name="2.0.0-beta3"></a>
## [2.0.0-beta3] - 2024-02-22
### ✨ Features
- **Notify:** Add WithDumpable trait and dump method ([3a97d10](https://github.com/guanguans/notify/commit/3a97d10))
- **Response:** Add __debugInfo method for Response class ([482f107](https://github.com/guanguans/notify/commit/482f107))
- **ToInternalExceptionRector:** Add ToInternalExceptionRector rule ([40ed71e](https://github.com/guanguans/notify/commit/40ed71e))
- **ToInternalExceptionRector:** Add ToInternalExceptionRector for internal exceptions handling ([7b59b90](https://github.com/guanguans/notify/commit/7b59b90))

### 💅 Code Refactorings
- **Exceptions:** Remove unused exception classes ([1df0313](https://github.com/guanguans/notify/commit/1df0313))
- **src:** Improve code readability and remove redundant functions ([60b8a64](https://github.com/guanguans/notify/commit/60b8a64))
- **src:** Update ToInternalExceptionRector to handle new class nodes ([84de364](https://github.com/guanguans/notify/commit/84de364))

### Pull Requests
- Merge pull request [#56](https://github.com/guanguans/notify/issues/56) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.68.0


<a name="2.0.0-beta2"></a>
## [2.0.0-beta2] - 2024-02-21
### ✨ Features
- **ClientTest:** add support for sending different types of messages ([daf695f](https://github.com/guanguans/notify/commit/daf695f))
- **YiFengChuanHua:** add ClientTest.php for sending message ([9159ef5](https://github.com/guanguans/notify/commit/9159ef5))
- **utils:** Add Utils class for converting form array into multipart array ([31da2fc](https://github.com/guanguans/notify/commit/31da2fc))
- **zulip:** add test for sending direct message ([d5a421c](https://github.com/guanguans/notify/commit/d5a421c))

### 💅 Code Refactorings
- **client:** remove Conditionable and Tappable traits ([57a038a](https://github.com/guanguans/notify/commit/57a038a))
- **concerns:** rename Traits to Concerns ([32c281a](https://github.com/guanguans/notify/commit/32c281a))
- **doc:** Update Http client doc comment ([7f3f63f](https://github.com/guanguans/notify/commit/7f3f63f))
- **doc:** Has options doc comment ([08e876e](https://github.com/guanguans/notify/commit/08e876e))
- **utils:** Improve readability of getHttpOptionsConstants method ([1c5b74f](https://github.com/guanguans/notify/commit/1c5b74f))

### ✅ Tests
- **Chanify:** Add tests for sending text and link messages ([97cf418](https://github.com/guanguans/notify/commit/97cf418))
- **ClientTest:** Add test case for sending message ([808b6b6](https://github.com/guanguans/notify/commit/808b6b6))
- **ClientTest:** Add test case for sending message ([f9ab637](https://github.com/guanguans/notify/commit/f9ab637))
- **ClientTest:** Add test for sending text message ([5131206](https://github.com/guanguans/notify/commit/5131206))
- **ClientTest:** add test for sending message functionality ([f9ad531](https://github.com/guanguans/notify/commit/f9ad531))
- **ClientTest:** add test for sending text messages ([72ef5ad](https://github.com/guanguans/notify/commit/72ef5ad))
- **Discord:** add test case for sending message ([72bed76](https://github.com/guanguans/notify/commit/72bed76))
- **IGot:** Add test case for sending message ([f1472f3](https://github.com/guanguans/notify/commit/f1472f3))
- **Push:** Add ClientTest.php for message sending functionality ([54bbac1](https://github.com/guanguans/notify/commit/54bbac1))
- **PushBack:** add ClientTest.php for testing sending messages ([262502c](https://github.com/guanguans/notify/commit/262502c))
- **PushPlus:** Add test for sending message ([30e24f6](https://github.com/guanguans/notify/commit/30e24f6))
- **Pushover:** add test for sending message ([a8311a6](https://github.com/guanguans/notify/commit/a8311a6))
- **RocketChat:** add test case for sending message ([7a00aa1](https://github.com/guanguans/notify/commit/7a00aa1))
- **ServerChan:** Add ClientTest.php for ServerChan client testing ([ea6ff44](https://github.com/guanguans/notify/commit/ea6ff44))
- **Showdoc:** Add test for sending message ([a5dd7ce](https://github.com/guanguans/notify/commit/a5dd7ce))
- **Slack:** Add test case for sending a message ([08a00e9](https://github.com/guanguans/notify/commit/08a00e9))
- **WeWorkGroupBot:** add test for sending message ([0d1cd88](https://github.com/guanguans/notify/commit/0d1cd88))
- **XiZhi:** add single and channel message test cases ([e2434dd](https://github.com/guanguans/notify/commit/e2434dd))
- **telegram:** Add test case for sending a message via Telegram client ([e9b5361](https://github.com/guanguans/notify/commit/e9b5361))

### Pull Requests
- Merge pull request [#55](https://github.com/guanguans/notify/issues/55) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.67.7
- Merge pull request [#51](https://github.com/guanguans/notify/issues/51) from guanguans/dependabot/github_actions/codecov/codecov-action-4
- Merge pull request [#54](https://github.com/guanguans/notify/issues/54) from guanguans/dependabot/github_actions/trufflesecurity/trufflehog-3.67.6


<a name="2.0.0-beta1"></a>
## [2.0.0-beta1] - 2024-02-19
### ✨ Features
- **Client:** add async method for sending messages ([b71f19a](https://github.com/guanguans/notify/commit/b71f19a))
- **DocCommentRector:** Add DocCommentRector class ([b7c9994](https://github.com/guanguans/notify/commit/b7c9994))
- **HasHttpClient:** Add mock method ([108ba10](https://github.com/guanguans/notify/commit/108ba10))
- **Notify:** add delete, head, patch, and put methods ([9bd0b6f](https://github.com/guanguans/notify/commit/9bd0b6f))
- **bark:** add Bark client, credential, and message classes ([7d074c0](https://github.com/guanguans/notify/commit/7d074c0))
- **client:** Add EnsureResponse middleware ([6cda2e2](https://github.com/guanguans/notify/commit/6cda2e2))
- **commit:** Add Conditionable and Macroable traits ([f479d0e](https://github.com/guanguans/notify/commit/f479d0e))
- **credentials:** add AggregateCredential class ([6ff1f12](https://github.com/guanguans/notify/commit/6ff1f12))
- **credentials:** add CertificateCredential class ([6b8e576](https://github.com/guanguans/notify/commit/6b8e576))
- **github:** add secrets check workflow ([a73bff1](https://github.com/guanguans/notify/commit/a73bff1))
- **mock:** add MockHandler class ([1230cd9](https://github.com/guanguans/notify/commit/1230cd9))
- **tests:** add XiZhi\ClientTest ([004430c](https://github.com/guanguans/notify/commit/004430c))

### 📖 Documents
- Update links and add examples for RocketChat and Slack clients ([f02ae92](https://github.com/guanguans/notify/commit/f02ae92))

### 💅 Code Refactorings
- Improve DocCommentRector and HasOptions ([8007879](https://github.com/guanguans/notify/commit/8007879))
- Update credentials classes ([470a871](https://github.com/guanguans/notify/commit/470a871))
- **Credentials:** Update ApiKeyCredential, DigestAuthCredential, HeaderCredential, and QueryCredential ([8fedb75](https://github.com/guanguans/notify/commit/8fedb75))
- **HasHttpClient:** refactor mock method ([0aca3cb](https://github.com/guanguans/notify/commit/0aca3cb))
- **Message:** Update toHttpUri() method ([2f23179](https://github.com/guanguans/notify/commit/2f23179))
- **MockHandler:** improve MockHandler class structure and functionality ([0c143fd](https://github.com/guanguans/notify/commit/0c143fd))
- **Response:** improve Response class ([efca7be](https://github.com/guanguans/notify/commit/efca7be))
- **Str:** Improve case conversion methods ([4b41193](https://github.com/guanguans/notify/commit/4b41193))
- **Traits:** Improve HasOptions trait ([30e6875](https://github.com/guanguans/notify/commit/30e6875))
- **UpdateHasHttpClientDocCommentRector:** Update createMethodPhpDocTagNode method ([31af609](https://github.com/guanguans/notify/commit/31af609))
- **client:** remove unused methods and add missing method ([87d57cb](https://github.com/guanguans/notify/commit/87d57cb))
- **client:** Refactor the Client class ([6ff05b6](https://github.com/guanguans/notify/commit/6ff05b6))
- **concerns:** Update options handling in traits ([9c81762](https://github.com/guanguans/notify/commit/9c81762))
- **concerns:** Remove unused imports ([9d7f1be](https://github.com/guanguans/notify/commit/9d7f1be))
- **config:** update PHP version and sets ([31bc189](https://github.com/guanguans/notify/commit/31bc189))
- **credentials:** refactor credential classes ([8fb8d8b](https://github.com/guanguans/notify/commit/8fb8d8b))
- **credentials:** refactor BasicAuthCredential, CallbackCredential, DigestAuthCredential, NtlmAuthCredential, and WsseAuthCredential classes ([8634605](https://github.com/guanguans/notify/commit/8634605))
- **handler:** refactor MockHandler constructor and response handling ([a9a8062](https://github.com/guanguans/notify/commit/a9a8062))
- **headercredential:** refactor applyToRequest method ([2a5532a](https://github.com/guanguans/notify/commit/2a5532a))
- **helper:** Refactor to_multipart function ([57afa6e](https://github.com/guanguans/notify/commit/57afa6e))
- **http-client:** Refactor HasHttpClient trait ([545d221](https://github.com/guanguans/notify/commit/545d221))
- **httpclient:** refactor send method ([b32e0b0](https://github.com/guanguans/notify/commit/b32e0b0))
- **middleware:** Refactor ApplyAuthenticatorToRequest and EnsureResponse middleware ([1d614f7](https://github.com/guanguans/notify/commit/1d614f7))
- **options:** Improve options handling in Traits ([38faad9](https://github.com/guanguans/notify/commit/38faad9))

### Pull Requests
- Merge pull request [#53](https://github.com/guanguans/notify/issues/53) from guanguans/1.x
- Merge pull request [#52](https://github.com/guanguans/notify/issues/52) from guanguans/dependabot/composer/rector/rector-tw-0.19or-tw-1.0
- Merge pull request [#50](https://github.com/guanguans/notify/issues/50) from guanguans/dependabot/github_actions/actions/setup-node-4
- Merge pull request [#49](https://github.com/guanguans/notify/issues/49) from guanguans/dependabot/github_actions/actions/cache-4


<a name="1.28.0"></a>
## [1.28.0] - 2024-01-17

<a name="1.27.2"></a>
## [1.27.2] - 2024-01-17
### ✨ Features
- **.zhlintrc:** add .zhlintrc file ([997b477](https://github.com/guanguans/notify/commit/997b477))

### ✅ Tests
- **rocketChat:** Skip RocketChat test ([3932a73](https://github.com/guanguans/notify/commit/3932a73))

### Pull Requests
- Merge pull request [#48](https://github.com/guanguans/notify/issues/48) from guanguans/dependabot/composer/rector/rector-tw-0.17or-tw-0.18or-tw-0.19
- Merge pull request [#47](https://github.com/guanguans/notify/issues/47) from guanguans/dependabot/github_actions/actions/stale-9
- Merge pull request [#46](https://github.com/guanguans/notify/issues/46) from guanguans/dependabot/github_actions/actions/labeler-5


<a name="1.27.1"></a>
## [1.27.1] - 2023-10-19
### 📖 Documents
- **readme:** update README links ([3a7f74e](https://github.com/guanguans/notify/commit/3a7f74e))


<a name="1.27.0"></a>
## [1.27.0] - 2023-10-07
### 🐞 Bug Fixes
- **client:** Update PushPlus request URL ([41d881d](https://github.com/guanguans/notify/commit/41d881d))

### ✅ Tests
- **QqChannelBotTest:** Skip testQqChannelBot ([1df9a26](https://github.com/guanguans/notify/commit/1df9a26))


<a name="1.26.1"></a>
## [1.26.1] - 2023-10-07
### Pull Requests
- Merge pull request [#45](https://github.com/guanguans/notify/issues/45) from guanguans/dependabot/github_actions/stefanzweifel/git-auto-commit-action-5
- Merge pull request [#43](https://github.com/guanguans/notify/issues/43) from guanguans/dependabot/github_actions/codecov/codecov-action-4
- Merge pull request [#42](https://github.com/guanguans/notify/issues/42) from guanguans/dependabot/github_actions/actions/checkout-4
- Merge pull request [#40](https://github.com/guanguans/notify/issues/40) from guanguans/dependabot/composer/rector/rector-tw-0.17or-tw-0.18


<a name="1.26.0"></a>
## [1.26.0] - 2023-08-16
### ✨ Features
- **monorepo-builder:** add new monorepo-builder.php file ([22db3f0](https://github.com/guanguans/notify/commit/22db3f0))

### 🐞 Bug Fixes
- **composer:** Resolve conflict with symplify/monorepo-builder ([f9432f4](https://github.com/guanguans/notify/commit/f9432f4))

### 📖 Documents
- **readme:** update README-EN.md and README.md ([bcb1b7f](https://github.com/guanguans/notify/commit/bcb1b7f))

### 💅 Code Refactorings
- **src:** apply rector ([cae947e](https://github.com/guanguans/notify/commit/cae947e))

### 🤖 Continuous Integrations
- **psalm.xml.dist:** update psalm config file ([e309227](https://github.com/guanguans/notify/commit/e309227))

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
### 📦 Builds
- **deps-dev:** Update friendsofphp/php-cs-fixer requirement || ^3.0 ([45fc5b9](https://github.com/guanguans/notify/commit/45fc5b9))

### Pull Requests
- Merge pull request [#4](https://github.com/guanguans/notify/issues/4) from guanguans/dependabot/composer/friendsofphp/php-cs-fixer-tw-2.16or-tw-3.0


<a name="v1.0.2"></a>
## [v1.0.2] - 2021-10-10
### 📦 Builds
- **deps:** Bump codecov/codecov-action from 1 to 2.1.0 ([3d35ef5](https://github.com/guanguans/notify/commit/3d35ef5))
- **deps-dev:** Update overtrue/phplint requirement || ^3.0 ([dadd746](https://github.com/guanguans/notify/commit/dadd746))
- **deps-dev:** Update vimeo/psalm requirement || ^4.0 ([cd01027](https://github.com/guanguans/notify/commit/cd01027))

### Pull Requests
- Merge pull request [#3](https://github.com/guanguans/notify/issues/3) from guanguans/dependabot/composer/overtrue/phplint-tw-2.3or-tw-3.0
- Merge pull request [#1](https://github.com/guanguans/notify/issues/1) from guanguans/dependabot/github_actions/codecov/codecov-action-2.1.0
- Merge pull request [#2](https://github.com/guanguans/notify/issues/2) from guanguans/dependabot/composer/vimeo/psalm-tw-3.11or-tw-4.0


<a name="v1.0.1"></a>
## [v1.0.1] - 2021-05-16
### ✨ Features
- Add separate method for separate setting option ([7a9c56d](https://github.com/guanguans/notify/commit/7a9c56d))

### 📖 Documents
- Update docs ([b855f7a](https://github.com/guanguans/notify/commit/b855f7a))

### 🏎 Performance Improvements
- Perf messages ([45b9d92](https://github.com/guanguans/notify/commit/45b9d92))
- Perf clients ([0693e1e](https://github.com/guanguans/notify/commit/0693e1e))


<a name="v1.0.0"></a>
## v1.0.0 - 2021-05-16
### ✨ Features
- Add some messages for FeiShu ([b9cf4c2](https://github.com/guanguans/notify/commit/b9cf4c2))
- Add FeiShu client ([241c649](https://github.com/guanguans/notify/commit/241c649))
- Add WeWork client ([01f5d7e](https://github.com/guanguans/notify/commit/01f5d7e))
- Add DingTalk client ([743f8fb](https://github.com/guanguans/notify/commit/743f8fb))
- Add Bark client ([219606f](https://github.com/guanguans/notify/commit/219606f))
- Add ServerChan client ([8613379](https://github.com/guanguans/notify/commit/8613379))
- Add XiZhi client ([a43f510](https://github.com/guanguans/notify/commit/a43f510))
- Add Chanify client ([3a002a2](https://github.com/guanguans/notify/commit/3a002a2))

### 🐞 Bug Fixes
- Fix message with secret ([3eb2976](https://github.com/guanguans/notify/commit/3eb2976))

### 📖 Documents
- Update docs ([a8af98a](https://github.com/guanguans/notify/commit/a8af98a))
- Add global `tap` function ([0602d52](https://github.com/guanguans/notify/commit/0602d52))
- Update README.md ([959f878](https://github.com/guanguans/notify/commit/959f878))
- Update README.md ([e5f924f](https://github.com/guanguans/notify/commit/e5f924f))

### 🎨 Styles
- Fix style ([e695dc3](https://github.com/guanguans/notify/commit/e695dc3))

### 💅 Code Refactorings
- Refactor ([45450d9](https://github.com/guanguans/notify/commit/45450d9))
- Refactor ([3c388f9](https://github.com/guanguans/notify/commit/3c388f9))
- Refactor FeiShu ([6ceb0ce](https://github.com/guanguans/notify/commit/6ceb0ce))
- Refactor FeiShu client ([9e7c42e](https://github.com/guanguans/notify/commit/9e7c42e))
- Refactor WeWork client ([ed40337](https://github.com/guanguans/notify/commit/ed40337))
- Refactor clients ([0581fe4](https://github.com/guanguans/notify/commit/0581fe4))
- Refactor Chanify client ([8d03d81](https://github.com/guanguans/notify/commit/8d03d81))

### 🏎 Performance Improvements
- Perf ServerChan ([9145b3f](https://github.com/guanguans/notify/commit/9145b3f))
- Perf XiZhi ([7bbc5d5](https://github.com/guanguans/notify/commit/7bbc5d5))
- Perf WeWork ([5b9d7dc](https://github.com/guanguans/notify/commit/5b9d7dc))
- Finish DingTalk ([1bd1bbb](https://github.com/guanguans/notify/commit/1bd1bbb))
- Finish FeiShu ([2dab48f](https://github.com/guanguans/notify/commit/2dab48f))
- Finish WeWork ([8eb688d](https://github.com/guanguans/notify/commit/8eb688d))
- Finish ServerChan ([2cdfab3](https://github.com/guanguans/notify/commit/2cdfab3))
- Finish XiZhi ([584f69e](https://github.com/guanguans/notify/commit/584f69e))
- Finish Chanify ([b403b81](https://github.com/guanguans/notify/commit/b403b81))
- Finish Bark ([7b46548](https://github.com/guanguans/notify/commit/7b46548))

### ✅ Tests
- Finish tests ([32e3c74](https://github.com/guanguans/notify/commit/32e3c74))


[Unreleased]: https://github.com/guanguans/notify/compare/3.3.0...HEAD
[3.3.0]: https://github.com/guanguans/notify/compare/3.2.2...3.3.0
[3.2.2]: https://github.com/guanguans/notify/compare/3.2.1...3.2.2
[3.2.1]: https://github.com/guanguans/notify/compare/3.2.0...3.2.1
[3.2.0]: https://github.com/guanguans/notify/compare/3.1.2...3.2.0
[3.1.2]: https://github.com/guanguans/notify/compare/3.1.1...3.1.2
[3.1.1]: https://github.com/guanguans/notify/compare/3.1.0...3.1.1
[3.1.0]: https://github.com/guanguans/notify/compare/3.0.2...3.1.0
[3.0.2]: https://github.com/guanguans/notify/compare/3.0.1...3.0.2
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
