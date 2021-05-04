<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Traits;

use Symfony\Component\OptionsResolver\OptionsResolver;

trait HasOptions
{
    // protected static $initOptions = [
    //     [
    //         'name'           => 'token',
    //         'allowed_types'  => ['string', 'int'],
    //         'default'        => 'b6eb70d9',
    //         'allowed_values' => ['b6eb70d9', 'b6eb70d8'],
    //         'info'           => '访问密钥',
    //         'normalizer'     => '',
    //         'is_required'    => true,
    //     ],
    // ];

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @return $this
     *
     * @throws \Exception
     */
    public function initOptions(array $initOptions)
    {
        foreach ($initOptions as $initOption) {
            if (! is_array($initOption)) {
                throw new \Exception('Init option must be a array.');
            }
            if (! array_key_exists('name', $initOption)) {
                throw new \Exception('Init option must be has key: name.');
            }

            $diffOptions = configure_options([], function (OptionsResolver $resolver) use ($initOption) {
                $resolver->setDefined([$initOption['name']]);
                isset($initOption['allowed_types']) && $resolver->setAllowedTypes($initOption['name'], $initOption['allowed_types']);
                isset($initOption['default']) && $resolver->setDefault($initOption['name'], $initOption['default']);
                isset($initOption['allowed_values']) && $resolver->setAllowedValues($initOption['name'], $initOption['allowed_values']);
                isset($initOption['info']) && $resolver->setInfo($initOption['name'], $initOption['info']);
                isset($initOption['normalizer']) && $resolver->setNormalizer($initOption['name'], $initOption['normalizer']);
                isset($initOption['is_required']) && $initOption['is_required'] && $resolver->setRequired([$initOption['name']]);
            });

            $this->options = array_merge($this->options, $diffOptions);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function setOptions(array $options): self
    {
        return $this->addOptions($options);
    }

    /**
     * @return $this
     */
    public function addOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * @return array|mixed
     */
    public function getOptions(string $key = null)
    {
        if ($key) {
            return $this->options[$key];
        }

        return $this->options;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setOption(string $key, $value): self
    {
        $this->setOptions([$key => $value]);

        return $this;
    }
}
