<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\FeiShu;

class Message extends \Guanguans\Notify\Messages\Message
{
    protected $type;

    public function transformToRequestParams()
    {
        $data = [
            'msg_type' => $this->type,
            'content' => $this->options,
        ];

        if ($this->options['secret']) {
            $data['timestamp'] = $time = time();
            $data['sign'] = $this->getSign($this->options['secret'], $time);
        }

        return $data;
    }

    /**
     * @return string
     */
    protected function getSign(string $secret, int $timestamp)
    {
        $stringToSign = sprintf("%s\n%s", $timestamp, $secret);

        $hash = hash_hmac('sha256', '', $stringToSign, true);

        return base64_encode($hash);
    }
}
