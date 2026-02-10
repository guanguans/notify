<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Ntfy\Messages;

use Guanguans\Notify\Foundation\Concerns\AsNullUri;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self actions(array $actions)
 * @method self attach(mixed $attach)
 * @method self cache(mixed $cache)
 * @method self call(mixed $call)
 * @method self click(mixed $click)
 * @method self delay(mixed $delay)
 * @method self email(mixed $email)
 * @method self filename(mixed $filename)
 * @method self firebase(mixed $firebase)
 * @method self icon(mixed $icon)
 * @method self markdown(mixed $markdown)
 * @method self message(mixed $message)
 * @method self pollId(mixed $pollId)
 * @method self priority(mixed $priority)
 * @method self tags(array $tags)
 * @method self title(mixed $title)
 * @method self topic(mixed $topic)
 * @method self unifiedPush(mixed $unifiedPush)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsNullUri;

    /** @var list<string> */
    protected array $required = [
        // 'topic',
    ];

    /** @var list<string> */
    protected array $defined = [
        'topic',
        'message',
        'title',
        'tags',
        'priority',
        'actions',
        'click',
        'attach',
        'markdown',
        'icon',
        'filename',
        'delay',
        'email',
        'call',
        'cache',
        'firebase',
        'unified_push',
        'poll_id',
    ];

    /** @var array<string, mixed> */
    protected array $allowedValues = [
        // 'priority' => [5, 4, 3, 2, 1],
        // 'cache' => ['yes', 'no'],
        // 'firebase' => ['yes', 'no'],
    ];

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [
        'tags' => 'array',
        'actions' => 'array[]',
    ];

    /** @var array<string, mixed> */
    protected array $options = [
        'actions' => [],
    ];

    /**
     * @api
     *
     * @param array<array-key, mixed> $action
     */
    public function addAction(array $action): self
    {
        $this->options['actions'][] = $action;

        return $this;
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefault('actions', static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setPrototype(true)
                ->setDefined([
                    'action', // [view, broadcast, http, click]
                    'label',
                    'clear',

                    'url', // view|http|click
                    'intent', // broadcast
                    'extras', // broadcast
                    'method', // http
                    'headers', // http
                    'body', // http
                    'method', // http
                ])
                ->setAllowedTypes('clear', 'bool')
                ->setAllowedTypes('extras', 'array')
                ->setAllowedTypes('headers', 'array');
        });
    }
}
