<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\WeWork;

use Guanguans\Notify\Messages\Message;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageMessage extends Message
{
    protected $type = 'image';

    protected $initOptions = [];

    /**
     * TextMessage constructor.
     *
     * @param string $text
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);
    }

    public function getData()
    {
        if ($this->options['image_path']) {
            $this->options['base64'] = $this->getBase64File($this->options['image_path']);
            $this->options['md5'] = $this->getMd5File($this->options['image_path']);
        }

        return $this->options;
    }

    public function getBase64File(string $imagePath)
    {
        return base64_encode(file_get_contents($imagePath));
    }

    public function getMd5File(string $imagePath)
    {
        return md5_file($imagePath);
    }

    /**
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $diffOptions = configure_options(array_diff($options, $this->options), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'image_path',
                'base64',
                'md5',
            ]);

            $resolver->setAllowedTypes('image_path', 'string');
            $resolver->setAllowedTypes('base64', 'string');
            $resolver->setAllowedTypes('md5', 'string');
        });

        $this->options = array_merge($this->options, $diffOptions);

        return $this;
    }
}
