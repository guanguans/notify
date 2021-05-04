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

class FeiShuClient extends AbstractClient
{
    public const ENDPOINT_URL_TEMPLATE = 'https://open.feishu.cn/open-apis/bot/v2/hook/%s';

    protected $contentIsMarkdown = false;

    protected static $httpOptions = [
        'headers' => ['Content-Type' => 'application/json'],
    ];

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $msgType = 'text';

    /**
     * @var array
     */
    protected $mentionedList = [];

    /**
     * @var array
     */
    protected $mentionedMobileList = [];

    /**
     * @var string
     */
    protected $base64;

    /**
     * @var string
     */
    protected $md5;

    /**
     * @var string
     */
    protected $imagePath;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $picurl;

    public function setOptions(array $options): AbstractClient
    {
        $diffOptions = configure_options(array_diff($options, $this->options), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'token',
                'title',
                'content',
                'msg_type',
                'mentioned_list',
                'mentioned_mobile_list',
                'base64',
                'md5',
                'image_path',
                'url',
                'picurl',
            ]);
            $resolver->setAllowedTypes('token', 'string');
            $resolver->setAllowedTypes('title', 'string');
            $resolver->setAllowedTypes('content', ['string', 'null']);
            $resolver->setAllowedTypes('image_path', 'string');

            $resolver->setAllowedValues('msg_type', ['text', 'post', 'image', 'share_chat', 'interactive']);
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
        switch ($this->getMsgType()) {
            case 'text':
                $data = [
                    'msg_type' => $this->msgType,
                    'content' => [
                        'text' => $this->getContent(),
                    ],
                ];
                break;
            case 'post':
                $data = [
                    'msg_type' => $this->getMsgType(),
                    'content' => [
                        'post' => [
                            'zh_cn' => [
                                'title' => '标题',
                                'content' => [
                                    [
                                        [
                                            'tag' => 'text',
                                            'text' => '项目有更新',
                                        ],
                                        [
                                            'tag' => 'a',
                                            'text' => '项目有更新',
                                            'href' => 'http://www.baidu.com/',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];
                break;
            case 'image':
                $data = [
                    'msgtype' => $this->msgType,
                    'image' => [
                        'base64' => $this->getBase64(),
                        'md5' => $this->getMd5(),
                    ],
                ];
                break;
            case 'news':
                $data = [
                    'msgtype' => $this->msgType,
                    'news' => [
                        'articles' => [
                            [
                                'title' => $this->getTitle(),
                                'description' => $this->getDescription(),
                                'url' => $this->getUrl(),
                                'picurl' => $this->getPicurl(),
                            ],
                        ],
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

    public function getContent(): string
    {
        if (true === $this->contentIsMarkdown) {
            return sprintf($this->markdownTemplate, $this->content);
        }

        return $this->content;
    }

    /**
     * @return $this
     */
    public function setTitle(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getMentionedList(): array
    {
        return $this->options['mentioned_list'];
    }

    public function getMentionedMobileList(): array
    {
        return $this->mentionedMobileList;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setMentionedList($value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setMentionedMobileList($value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getMsgType(): string
    {
        return $this->options['msg_type'];
    }

    /**
     * @return $this
     */
    public function setMsgType(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getBase64()
    {
        return base64_encode(file_get_contents($this->options['image_path']));
    }

    public function getMd5()
    {
        return md5_file($this->options['image_path']);
    }

    /**
     * @return $this
     */
    public function setBase64(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    /**
     * @return $this
     */
    public function setMd5(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    /**
     * @return $this
     */
    public function setImagePath(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getPicurl()
    {
        return $this->picurl;
    }

    /**
     * @return $this
     */
    public function setDescription(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    /**
     * @return $this
     */
    public function setUrl(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    /**
     * @return $this
     */
    public function setPicurl(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }
}
