<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\FeiShu;

use Guanguans\Notify\Messages\Message;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostMessage extends Message
{
    protected $type = 'post';

    /**
     * @var string[]
     */
    protected $defined = [
        'post',
    ];

    /**
     * PostMessage constructor.
     */
    public function __construct(array $post = [])
    {
        parent::__construct([
            'post' => $post,
        ]);
    }

    public function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($resolver), function ($resolver) {
            $resolver->setAllowedTypes('post', 'array');
        });
    }

    public function transformToRequestParams()
    {
        return [
            'msg_type' => $this->type,
            'content' => $this->getOptions(),
        ];
    }
}
