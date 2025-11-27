<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\ZohoCliq\Messages;

trait ThreadConfig
{
    final public function setThreadId(int $slice01, int $slice02): self
    {
        $this->options['thread_message_id'] = \sprintf('%s_%s', $slice01, $slice02);

        return $this;
    }

    final public function setThreadTitle(string $title): self
    {
        $this->options['thread_title'] = $title;

        return $this;
    }

    final public function setThreadPostInParent(): self
    {
        $this->options['post_in_parent'] = true;

        return $this;
    }
}
