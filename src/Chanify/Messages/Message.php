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

use Guanguans\Notify\Chanify\Credential;
use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;

class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    private string $baseUri;

    public function __construct(array $options = [])
    {
        parent::__construct($options);
        $this->baseUri = sprintf('https://api.chanify.net/v1/sender/%s', Credential::TEMPLATE_TOKEN);
    }

    public function httpUri()
    {
        return $this->baseUri;
    }

    public function baseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;

        return $this;
    }
}
