<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

use Symfony\Component\OptionsResolver\OptionsResolver;

class DingTalkClient extends AbstractClient
{
    public const ENDPOINT_URL_TEMPLATE = 'https://oapi.dingtalk.com/robot/send?access_token=%s';

    protected static $httpOptions = [
        'headers' => ['Content-Type' => 'application/json'],
    ];

    /**
     * @var string
     */
    protected $msgtype = 'text';

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $keyword;

    /**
     * @var bool
     */
    protected $isAtAll = false;

    /**
     * @var array
     */
    protected $atMobiles = [];

    /**
     * @var array
     */
    protected $atUserIds = [];

    /**
     * @var string
     */
    protected $picUrl;

    /**
     * @var string
     */
    protected $messageUrl;

    /**
     * @var string
     */
    protected $singleTitle;

    /**
     * @var string
     */
    protected $singleUrl;

    /**
     * @var string
     */
    protected $btnOrientation = '0';

    /**
     * @var string
     */
    protected $hideAvatar = '0';

    /**
     * @var array
     */
    protected $btns = [];

    /**
     * @var array
     */
    protected $links = [];

    public function setOptions(array $options): AbstractClient
    {
        $diffOptions = configure_options(array_diff($options, $this->options), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'token',
                'msgtype',
                'keyword',

                'content',
                'at_mobiles',
                'at_user_ids',
                'is_at_all',

                'title',
                'pic_url',
                'message_url',

                'btn_orientation',
                'hide_avatar',

                'single_url',
                'single_title',

                'links',
            ]);

            $resolver->setDefault('is_at_all', false);

            $resolver->setAllowedTypes('token', 'string');
            $resolver->setAllowedTypes('msgtype', 'string');
            $resolver->setAllowedTypes('keyword', 'string');
            $resolver->setAllowedTypes('title', 'string');
            $resolver->setAllowedTypes('content', 'string');
            $resolver->setAllowedTypes('at_mobiles', 'array');
            $resolver->setAllowedTypes('at_user_ids', 'array');
            $resolver->setAllowedTypes('links', 'array');
            $resolver->setAllowedTypes('is_at_all', 'bool');
            $resolver->setAllowedTypes('pic_url', 'string');
            $resolver->setAllowedTypes('message_url', 'string');
            $resolver->setAllowedTypes('btn_orientation', 'string');
            $resolver->setAllowedTypes('single_url', 'string');
            $resolver->setAllowedTypes('single_title', 'string');

            $resolver->setAllowedValues('btn_orientation', ['0', '1']);
            $resolver->setAllowedValues('hide_avatar', ['0', '1']);
            $resolver->setAllowedValues('msgtype', ['text', 'link', 'markdown', 'actionCard', 'feedCard']);
            $resolver->setAllowedValues('pic_url', function ($value) {
                return false !== filter_var($value, FILTER_VALIDATE_URL);
            });
            $resolver->setAllowedValues('message_url', function ($value) {
                return false !== filter_var($value, FILTER_VALIDATE_URL);
            });
            $resolver->setAllowedValues('single_url', function ($value) {
                return false !== filter_var($value, FILTER_VALIDATE_URL);
            });
        });

        $this->options = array_merge($this->options, $diffOptions);
        $this->setOptionsToProperties($this->options);

        return $this;
    }

    public function send()
    {
        return $this->getHttpClient(static::$httpOptions)->request($this->getEndpointUrl(), 'POST', $this->getParams());
    }

    public function getEndpointUrl(): string
    {
        return sprintf(static::ENDPOINT_URL_TEMPLATE, $this->token);
    }

    public function getData(): array
    {
        switch ($this->getMsgtype()) {
            case 'text':
                $data = [
                    'msgtype' => $this->msgtype,
                    'text' => [
                        'content' => $this->getContent(),
                    ],
                    'at' => [
                        'atMobiles' => $this->getAtMobiles(),
                        'atUserIds' => $this->getAtUserIds(),
                        'isAtAll' => $this->isAtAll(),
                    ],
                ];
                break;
            case 'link':
                $data = [
                    'msgtype' => $this->msgtype,
                    'link' => [
                        'title' => $this->getTitle(),
                        'text' => $this->getContent(),
                        'picUrl' => $this->getPicUrl(),
                        'messageUrl' => $this->getMessageUrl(),
                    ],
                ];
                break;
            case 'markdown':
                $data = [
                    'msgtype' => $this->msgtype,
                    'markdown' => [
                        'title' => $this->getTitle(),
                        'text' => $this->getContent(),
                    ],
                    'at' => [
                        'atMobiles' => $this->getAtMobiles(),
                        'atUserIds' => $this->getAtUserIds(),
                        'isAtAll' => $this->isAtAll(),
                    ],
                ];
                break;
            case 'actionCard':
                $data = [
                    'msgtype' => $this->msgtype,
                    'actionCard' => [
                        'title' => $this->getTitle(),
                        'text' => $this->getContent(),
                        'btnOrientation' => $this->getBtnOrientation(),

                        'singleTitle' => $this->getSingleTitle(),
                        'singleURL' => $this->getSingleUrl(),

                        'hideAvatar' => '0',
                        'btns' => [
                            [
                                'title' => '内容不错',
                                'actionURL' => 'https://www.dingtalk.com/',
                            ],
                        ],
                    ],
                ];
                break;
            case 'feedCard':
                $data = [
                    'msgtype' => $this->msgtype,
                    'feedCard' => [
                        'links' => $this->getLinks(),
                    ],
                ];
                break;
            default:
                break;
        }

        return $data;
    }

    public function getParams()
    {
        return array_merge(self::$httpOptions, ['json' => $this->getData()]);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return $this
     */
    public function setTitle(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getMsgtype(): string
    {
        return $this->msgtype;
    }

    /**
     * @return $this
     */
    public function setMsgtype(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }

    /**
     * @return $this
     */
    public function setKeyword(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function isAtAll(): bool
    {
        return $this->options['is_at_all'];
    }

    /**
     * @return $this
     */
    public function setIsAtAll(bool $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getAtMobiles(): array
    {
        return $this->atMobiles;
    }

    /**
     * @return $this
     */
    public function setAtMobiles(array $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getAtUserIds(): array
    {
        return $this->atUserIds;
    }

    /**
     * @return $this
     */
    public function setAtUserIds(array $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getPicUrl(): ?string
    {
        return $this->options['pic_url'];
    }

    /**
     * @return $this
     */
    public function setPicUrl(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getMessageUrl(): ?string
    {
        return $this->options['message_url'];
    }

    /**
     * @return $this
     */
    public function setMessageUrl(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getSingleTitle(): ?string
    {
        return $this->singleTitle;
    }

    /**
     * @return $this
     */
    public function setSingleTitle(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getSingleUrl(): ?string
    {
        return $this->singleUrl;
    }

    /**
     * @return $this
     */
    public function setSingleUrl(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getBtnOrientation(): string
    {
        return $this->btnOrientation;
    }

    /**
     * @return $this
     */
    public function setBtnOrientation(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getBtns(): array
    {
        return $this->btns;
    }

    /**
     * @return $this
     */
    public function setBtns(array $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getHideAvatar(): string
    {
        return $this->hideAvatar;
    }

    /**
     * @return $this
     */
    public function setHideAvatar(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @return $this
     */
    public function setLinks(array $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }
}
