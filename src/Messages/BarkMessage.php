<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

class BarkMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'title',
        'text',
        'copy',
        'url',
        'sound',
        'isArchive',
        'automaticallyCopy',
    ];

    /**
     * @var array
     */
    protected $options = [
        'sound' => 'bell',
        'isArchive' => 1,
        'automaticallyCopy' => 1,
    ];

    /**
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->setOption('title', $title);

        return $this;
    }

    /**
     * @return $this
     */
    public function setText(string $text)
    {
        $this->setOption('text', $text);

        return $this;
    }

    /**
     * @return $this
     */
    public function setCopy(string $copy)
    {
        $this->setOption('copy', $copy);

        return $this;
    }

    /**
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->setOption('url', $url);

        return $this;
    }

    /**
     * @return $this
     */
    public function setSound(string $sound)
    {
        $this->setOption('sound', $sound);

        return $this;
    }

    /**
     * @return $this
     */
    public function setIsArchive(int $isArchive)
    {
        $this->setOption('isArchive', $isArchive);

        return $this;
    }

    /**
     * @return $this
     */
    public function setAutomaticallyCopy(int $automaticallyCopy)
    {
        $this->setOption('automaticallyCopy', $automaticallyCopy);

        return $this;
    }
}
