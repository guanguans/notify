<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Pushback;

/**
 * @see https://pushback.io/docs/getting-started
 *
 * ```
 * curl https://api.pushback.io/v1/send_sync \
 * -u at_uDCCK8gdHJPN613lASV: \
 * -d 'id=User_1730' \
 * -d 'title=Send notifications' \
 * -d 'body=Get responses back' \
 * -d 'action1=Action1' \
 * -d 'action2=Action2' \
 * -d 'reply=Reply'
 * ```
 */
class Client extends \Guanguans\Notify\Foundation\Client {}
