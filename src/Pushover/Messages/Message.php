<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Pushover\Messages;

use Guanguans\Notify\Foundation\Concerns\AsMultipart;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use GuzzleHttp\Psr7\Utils;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method \Guanguans\Notify\Pushover\Messages\Message message($message)
 * @method \Guanguans\Notify\Pushover\Messages\Message title($title)
 * @method \Guanguans\Notify\Pushover\Messages\Message timestamp($timestamp)
 * @method \Guanguans\Notify\Pushover\Messages\Message priority($priority)
 * @method \Guanguans\Notify\Pushover\Messages\Message url($url)
 * @method \Guanguans\Notify\Pushover\Messages\Message urlTitle($urlTitle)
 * @method \Guanguans\Notify\Pushover\Messages\Message sound($sound)
 * @method \Guanguans\Notify\Pushover\Messages\Message retry($retry)
 * @method \Guanguans\Notify\Pushover\Messages\Message expire($expire)
 * @method \Guanguans\Notify\Pushover\Messages\Message html($html)
 * @method \Guanguans\Notify\Pushover\Messages\Message monospace($monospace)
 * @method \Guanguans\Notify\Pushover\Messages\Message callback($callback)
 * @method \Guanguans\Notify\Pushover\Messages\Message device($device)
 * @method \Guanguans\Notify\Pushover\Messages\Message attachment($attachment)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsMultipart;
    use AsPost;

    protected array $defined = [
        // 'token',
        // 'user',
        'message',
        'title',
        'timestamp',
        'priority',
        'url',
        'url_title',
        'sound',
        'retry',
        'expire',
        'html',
        'monospace',
        'callback',
        'device',
        'attachment',

        // 'attachment_base64',
        // 'attachment_type',
    ];

    protected array $required = [
        // 'token',
        // 'user',
        'message',
    ];

    protected array $allowedTypes = [
        'timestamp' => 'int',
        'priority' => 'int',
        'retry' => 'int',
        'expire' => 'int',
        'html' => 'int',
        'monospace' => 'int',
        'attachment' => ['string', 'resource'],
    ];

    /**
     * @var array<array<\int>>
     */
    protected array $allowedValues = [
        'priority' => [-2, -1, 0, 1, 2],
        'html' => [0, 1],
        'monospace' => [0, 1],
    ];

    public function toHttpUri(): string
    {
        return 'https://api.pushover.net/1/messages.json';
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(
            parent::configureOptionsResolver($optionsResolver),
            static function (OptionsResolver $optionsResolver): void {
                $optionsResolver->setNormalizer(
                    'priority',
                    static function (OptionsResolver $optionsResolver, $value): int {
                        if (2 !== $value) {
                            return $value;
                        }

                        if (isset($optionsResolver['retry'], $optionsResolver['expire'])) {
                            return $value;
                        }

                        throw new MissingOptionsException('The required option "retry" or "expire" is missing.');
                    }
                );

                $optionsResolver->setNormalizer(
                    'html',
                    static function (OptionsResolver $optionsResolver, $value): int {
                        if (1 !== $value) {
                            return $value;
                        }

                        if (! isset($optionsResolver['monospace'])) {
                            return $value;
                        }

                        if (1 !== $optionsResolver['monospace']) {
                            return $value;
                        }

                        throw new InvalidOptionsException('Html cannot be set with monospace, Monospace cannot be set with html, Html and monospace are mutually.');
                    }
                );

                // $optionsResolver->setNormalizer(
                //     'attachment',
                //     static function (OptionsResolver $optionsResolver, $value) {
                //         if (\is_string($value)) {
                //             // $value = fopen($value, 'r');
                //             $value = Utils::tryFopen($value, 'r');
                //         }
                //
                //         return $value;
                //     }
                // );
            }
        );
    }
}
