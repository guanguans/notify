<!--- BEGIN HEADER -->
# Changelog

All notable changes to this project will be documented in this file.
<!--- END HEADER -->

<a name="unreleased"></a>
## [Unreleased]


<a name="2.0.0-beta2"></a>
## [2.0.0-beta2] - 2024-02-21
### Feat
- **ClientTest:** add support for sending different types of messages
- **YiFengChuanHua:** add ClientTest.php for sending message
- **utils:** Add Utils class for converting form array into multipart array
- **zulip:** add test for sending direct message

### Refactor
- **client:** remove Conditionable and Tappable traits
- **concerns:** rename Traits to Concerns
- **doc:** Update Http client doc comment
- **doc:** Has options doc comment
- **utils:** Improve readability of getHttpOptionsConstants method

### Test
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
### Docs
- Update links and add examples for RocketChat and Slack clients

### Feat
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

### Refactor
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

### Pull Requests
- Merge pull request [#53](https://github.com/guanguans/notify/issues/53) from guanguans/1.x
- Merge pull request [#52](https://github.com/guanguans/notify/issues/52) from guanguans/dependabot/composer/rector/rector-tw-0.19or-tw-1.0
- Merge pull request [#50](https://github.com/guanguans/notify/issues/50) from guanguans/dependabot/github_actions/actions/setup-node-4
- Merge pull request [#49](https://github.com/guanguans/notify/issues/49) from guanguans/dependabot/github_actions/actions/cache-4


<a name="1.28.0"></a>
## [1.28.0] - 2024-01-17

<a name="1.27.2"></a>
## [1.27.2] - 2024-01-17
### Feat
- **.zhlintrc:** add .zhlintrc file

### Test
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
### Fix
- **client:** Update PushPlus request URL

### Test
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
### CI
- **psalm.xml.dist:** update psalm config file

### Docs
- **readme:** update README-EN.md and README.md

### Feat
- **monorepo-builder:** add new monorepo-builder.php file

### Fix
- **composer:** Resolve conflict with symplify/monorepo-builder

### Refactor
- **src:** apply rector

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
### Pull Requests
- Merge pull request [#4](https://github.com/guanguans/notify/issues/4) from guanguans/dependabot/composer/friendsofphp/php-cs-fixer-tw-2.16or-tw-3.0


<a name="v1.0.2"></a>
## [v1.0.2] - 2021-10-10
### Pull Requests
- Merge pull request [#3](https://github.com/guanguans/notify/issues/3) from guanguans/dependabot/composer/overtrue/phplint-tw-2.3or-tw-3.0
- Merge pull request [#1](https://github.com/guanguans/notify/issues/1) from guanguans/dependabot/github_actions/codecov/codecov-action-2.1.0
- Merge pull request [#2](https://github.com/guanguans/notify/issues/2) from guanguans/dependabot/composer/vimeo/psalm-tw-3.11or-tw-4.0


<a name="v1.0.1"></a>
## [v1.0.1] - 2021-05-16
### Docs
- Update docs

### Feat
- Add separate method for separate setting option

### Perf
- Perf messages
- Perf clients


<a name="v1.0.0"></a>
## v1.0.0 - 2021-05-16
### Docs
- Update docs
- Add global `tap` function
- Update README.md
- Update README.md

### Feat
- Add some messages for FeiShu
- Add FeiShu client
- Add WeWork client
- Add DingTalk client
- Add Bark client
- Add ServerChan client
- Add XiZhi client
- Add Chanify client

### Fix
- Fix message with secret

### Perf
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

### Refactor
- Refactor
- Refactor
- Refactor FeiShu
- Refactor FeiShu client
- Refactor WeWork client
- Refactor clients
- Refactor Chanify client

### Test
- Finish tests


[Unreleased]: https://github.com/guanguans/notify/compare/2.0.0-beta2...HEAD
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
