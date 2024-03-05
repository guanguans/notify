<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Ntfy\Messages;

use Guanguans\Notify\Foundation\Concerns\AsNullUri;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self topic($topic)
 * @method self message($message)
 * @method self title($title)
 * @method self tags(array $tags)
 * @method self priority($priority)
 * @method self actions(array $actions)
 * @method self click($click)
 * @method self attach($attach)
 * @method self markdown($markdown)
 * @method self icon($icon)
 * @method self filename($filename)
 * @method self delay($delay)
 * @method self email($email)
 * @method self call($call)
 * @method self cache($cache)
 * @method self firebase($firebase)
 * @method self unifiedPush($unifiedPush)
 * @method self pollId($pollId)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsNullUri;

    protected array $required = [
        // 'topic',
    ];

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

    protected array $allowedValues = [
        // 'priority' => [5, 4, 3, 2, 1],
        // 'cache' => ['yes', 'no'],
        // 'firebase' => ['yes', 'no'],
    ];

    protected array $allowedTypes = [
        'tags' => 'array',
        'actions' => 'array',
    ];

    protected array $options = [
        'actions' => [],
    ];

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
