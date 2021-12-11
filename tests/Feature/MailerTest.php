<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Tests\Feature;

use Guanguans\Notify\Factory;
use Guanguans\Notify\Tests\TestCase;

class MailerTest extends TestCase
{
    public function testMailer()
    {
        $this->expectException(\Symfony\Component\Mailer\Exception\TransportException::class);
        $email = (new \Guanguans\Notify\Messages\EmailMessage())
            ->from('from@qq.com')
            ->to('to@qq.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('replyTo@example.com')
            // ->priority(\Guanguans\Notify\Messages\EmailMessage::PRIORITY_HIGH)
            ->subject('This is a testing for notify.')
            // ->html('<p>Sending emails is fun again!</p>')
            ->text('This is a testing.');

        Factory::mailer()
            // ->setDsn('smtp://53222411@qq.com:kisvmysjlnipbigg@smtp.qq.com:465?verify_peer=0')
            ->setDsn('smtp://user:pass@smtp.qq.com:465?verify_peer=0')
            ->setMessage($email)
            ->send();
    }
}
