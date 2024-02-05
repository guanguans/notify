<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Chanify\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\Foundation\Credentials\TokenUriTemplateCredential;

class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    protected array $options = [
        'base_uri' => 'https://api.chanify.net/v1',
    ];

    public function toHttpUri(): string
    {
        return sprintf("{$this->getOption('base_uri')}/sender/{%s}", TokenUriTemplateCredential::TEMPLATE);
    }
}
