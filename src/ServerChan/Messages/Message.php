<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\ServerChan\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\ServerChan\Credential;

/**
 * @method \Guanguans\Notify\ServerChan\Messages\Message title($title)
 * @method \Guanguans\Notify\ServerChan\Messages\Message desp($desp)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    /**
     * @var array<string>
     */
    protected array $defined = [
        'title',
        'desp',
    ];

    public function __construct(string $title, string $desp = '')
    {
        parent::__construct([
            'title' => $title,
            'desp' => $desp,
        ]);
    }

    public function toHttpUri()
    {
        return sprintf('https://sctapi.ftqq.com/%s.send', Credential::TEMPLATE);
    }
}
