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

/**
 * @method self title($title)
 * @method self desp($desp)
 * @method self short($short)
 * @method self noip($noip)
 * @method self channel($channel)
 * @method self openid($openid)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    protected array $defined = [
        'title',
        'desp',
        'short',
        'noip',
        'channel',
        'openid',

        // 'encoded',
        // 'key',
        // 'uid',
    ];

    public function toHttpUri(): string
    {
        return 'https://sctapi.ftqq.com/{token}.send';
    }

    /**
     * @noinspection EncryptionInitializationVectorRandomnessInspection
     * @noinspection PhpComposerExtensionStubsInspection
     * @noinspection PhpUnusedPrivateMethodInspection
     *
     * @codeCoverageIgnore
     */
    private function encrypt(string $content, string $key, string $iv): string
    {
        $key = substr(md5($key), 0, 16);
        $iv = substr(md5($iv), 0, 16);

        return openssl_encrypt(base64_encode($content), 'AES-128-CBC', $key, 0, $iv);
    }
}
