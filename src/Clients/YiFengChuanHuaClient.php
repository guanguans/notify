<?php

/**
 * @see http://push.phprm.com/api.html
 *
 * ```
 * // send a get.
 * curl --location --request GET 'https://www.phprm.com/services/push/trigger/{{token}}?head=title&body=content' \
 *
 * // send a post.
 * curl --location --request POST 'https://www.phprm.com/services/push/trigger/{{token}}' \
 * --header 'Content-Type: application/json' \
 * --data-raw '{"head":"This is title.","body":"This is content."}'
 * ```
 * mobile manage url: https://www.phprm.com/push/h5/
 */
namespace Guanguans\Notify\Clients;

class YiFengChuanHuaClient extends Client
{

    public const REQUEST_URL_TEMPLATE = 'https://www.phprm.com/services/push/trigger/%s';

    public $requestMethod = 'postJson';

    public function getRequestUrl(): string
    {
        return sprintf(static::REQUEST_URL_TEMPLATE, $this->getToken());
    }

    public function setRequestMethod(string $requestMethod)
    {
        $this->requestMethod = $requestMethod;

        return $this;
    }
}
