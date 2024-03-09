<?php

/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\NotifyTests\WeWork;

use Guanguans\Notify\WeWork\Authenticator;
use Guanguans\Notify\WeWork\Client;
use Guanguans\Notify\WeWork\Messages\FileMessage;
use Guanguans\Notify\WeWork\Messages\ImageMessage;
use Guanguans\Notify\WeWork\Messages\MarkdownMessage;
use Guanguans\Notify\WeWork\Messages\NewsMessage;
use Guanguans\Notify\WeWork\Messages\TemplateCardMessage;
use Guanguans\Notify\WeWork\Messages\TextMessage;
use Guanguans\Notify\WeWork\Messages\UploadMediaMessage;
use Guanguans\Notify\WeWork\Messages\VoiceMessage;

beforeEach(function (): void {
    $authenticator = new Authenticator('73a3d5a3-ceff-4da8-bcf3-ff5891778');
    $this->client = (new Client($authenticator))->mock([
        create_response('{"errcode":0,"errmsg":"ok"}'),
        create_response('{"errcode":93000,"errmsg":"invalid webhook url, hint: [1708397705432012366598976], from ip: 218.72.126.124, more info at https://open.work.weixin.qq.com/devtool/query?e=93000"}'),
    ]);
});

it('can send upload media message', function (): void {
    $uploadMediaMessage = UploadMediaMessage::make([
        'media' => fixtures_path('image.png'),
        'type' => 'file',
    ]);

    expect($this->client)
        ->mock([
            create_response('{"errcode":0,"errmsg":"ok","type":"file","media_id":"3h9Ps2X6_-HSlzxXyRJibTGRREIkBPgtZIG0dPRJFlOl5bKroWVHXaTQQV6sSPz5h","created_at":"1709387991"}'),
            create_response('{"errcode":40058,"errmsg":"invalid param \'key\', hint: [1709388087101961098685339], from ip: 211.90.236.131, more info at https://open.work.weixin.qq.com/devtool/query?e=40058"}'),
        ])
        ->assertCanSendMessage($uploadMediaMessage);
})->group(__DIR__, __FILE__);

it('can send text message', function (): void {
    $textMessage = TextMessage::make([
        'content' => 'This is content.',
        'mentioned_list' => ['wangqing', '@all'],
        'mentioned_mobile_list' => ['13800001111', '@all'],
    ]);

    expect($this->client)->assertCanSendMessage($textMessage);
})->group(__DIR__, __FILE__);

it('can send file message', function (): void {
    $fileMessage = FileMessage::make()->mediaId('3NmBZNxOun8TK5zIGo18LZ3ttVeoGnWIkxcynSxlVCuiw5WcUhO-arRBMwXSGeCYw');

    expect($this->client)->assertCanSendMessage($fileMessage);
})->group(__DIR__, __FILE__);

it('can send image message', function (): void {
    $imageMessage = ImageMessage::make()->image(fixtures_path('image.png'));

    expect($this->client)->assertCanSendMessage($imageMessage);
})->group(__DIR__, __FILE__);

it('can send markdown message', function (): void {
    $markdownMessage = MarkdownMessage::make()->content("# This is title.\n>This is content.");

    expect($this->client)->assertCanSendMessage($markdownMessage);
})->group(__DIR__, __FILE__);

it('can send news message', function (): void {
    $newsMessage = NewsMessage::make()->addArticle([
        'title' => 'This is title.',
        'description' => 'This is description.',
        'url' => 'https://github.com/guanguans/notify',
        'picurl' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
    ]);

    expect($this->client)->assertCanSendMessage($newsMessage);
})->group(__DIR__, __FILE__);

it('can send template card of text message', function (): void {
    $templateCardMessage = TemplateCardMessage::make([
        'card_type' => 'text_notice',
        'source' => [
            'icon_url' => 'https://wework.qpic.cn/wwpic/252813_jOfDHtcISzuodLa_1629280209/0',
            'desc' => '企业微信',
            'desc_color' => 0,
        ],
        'main_title' => [
            'title' => '欢迎使用企业微信',
            'desc' => '您的好友正在邀请您加入企业微信',
        ],
        'emphasis_content' => [
            'title' => '100',
            'desc' => '数据含义',
        ],
        'quote_area' => [
            'type' => 1,
            'url' => 'https://work.weixin.qq.com/?from=openApi',
            'appid' => 'APPID',
            'pagepath' => 'PAGEPATH',
            'title' => '引用文本标题',
            'quote_text' => 'Jack：企业微信真的很好用~',
        ],
        'sub_title_text' => '下载企业微信还能抢红包！',
        'horizontal_content_list' => [
            $horizontalContent = [
                'keyname' => '企微官网',
                'value' => '点击访问',
                'type' => 1,
                'url' => 'https://work.weixin.qq.com/?from=openApi',
            ],
        ],
        'jump_list' => [
            $jump = [
                'type' => 1,
                'url' => 'https://work.weixin.qq.com/?from=openApi',
                'title' => '企业微信官网',
            ],
        ],
        'card_action' => [
            'type' => 1,
            'url' => 'https://work.weixin.qq.com/?from=openApi',
            'appid' => 'APPID',
            'pagepath' => 'PAGEPATH',
        ],
    ])
        ->addHorizontalContent($horizontalContent)
        ->addJump($jump);

    expect($this->client)->assertCanSendMessage($templateCardMessage);
})->group(__DIR__, __FILE__);

it('can send template card of news message', function (): void {
    $templateCardMessage = TemplateCardMessage::make([
        'card_type' => 'news_notice',
        'source' => [
            'icon_url' => 'https://wework.qpic.cn/wwpic/252813_jOfDHtcISzuodLa_1629280209/0',
            'desc' => '企业微信',
            'desc_color' => 0,
        ],
        'main_title' => [
            'title' => '欢迎使用企业微信',
            'desc' => '您的好友正在邀请您加入企业微信',
        ],
        'card_image' => [
            'url' => 'https://wework.qpic.cn/wwpic/354393_4zpkKXd7SrGMvfg_1629280616/0',
            'aspect_ratio' => 2.25,
        ],
        'image_text_area' => [
            'type' => 1,
            'url' => 'https://work.weixin.qq.com',
            'title' => '欢迎使用企业微信',
            'desc' => '您的好友正在邀请您加入企业微信',
            'image_url' => 'https://wework.qpic.cn/wwpic/354393_4zpkKXd7SrGMvfg_1629280616/0',
        ],
        'quote_area' => [
            'type' => 1,
            'url' => 'https://work.weixin.qq.com/?from=openApi',
            'appid' => 'APPID',
            'pagepath' => 'PAGEPATH',
            'title' => '引用文本标题',
            'quote_text' => 'Jack：企业微信真的很好用~Balian：超级好的一款软件！',
        ],
        'vertical_content_list' => [
            $verticalContent = [
                'title' => '惊喜红包等你来拿',
                'desc' => '下载企业微信还能抢红包！',
            ],
        ],
        'horizontal_content_list' => [
            $horizontalContent = [
                'keyname' => '企微官网',
                'value' => '点击访问',
                'type' => 1,
                'url' => 'https://work.weixin.qq.com/?from=openApi',
            ],
        ],
        'jump_list' => [
            $jump = [
                'type' => 1,
                'url' => 'https://work.weixin.qq.com/?from=openApi',
                'title' => '企业微信官网',
            ],
        ],
        'card_action' => [
            'type' => 1,
            'url' => 'https://work.weixin.qq.com/?from=openApi',
            'appid' => 'APPID',
            'pagepath' => 'PAGEPATH',
        ],
    ])
        ->addVerticalContent($verticalContent)
        ->addHorizontalContent($horizontalContent)
        ->addJump($jump);

    expect($this->client)->assertCanSendMessage($templateCardMessage);
})->group(__DIR__, __FILE__);

it('can send voice message', function (): void {
    $voiceMessage = VoiceMessage::make()->mediaId('3NmBZNxOun8TK5zIGo18LZ3ttVeoGnWIkxcynSxlVCuiw5WcUhO-arRBMwXSGeCYw');

    expect($this->client)->assertCanSendMessage($voiceMessage);
})->group(__DIR__, __FILE__);
