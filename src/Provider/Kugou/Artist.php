<?php

namespace Teakowa\Octo\Provider\Kugou;

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\API;

class Artist implements API
{
    private $url;
    private $adapter;
    private $body;

    public function __construct(Adapter $adapter)
    {
        $this->url     = 'http://m.kugou.com/singer/';
        $this->adapter = $adapter;
    }

    /**
     * @return \stdClass
     */
    public function class(): \stdClass
    {
        $class      = $this->adapter->get($this->url.'class', ['json' => true]);
        $this->body = json_decode($class->getBody());

        return (object) $this->body;
    }

    public function list(int $id, int $page = null): \stdClass
    {
        $list       = $this->adapter->get($this->url.'list/'.$id, ['page' => $page, 'json' => true]);
        $this->body = json_decode($list->getBody());

        return (object) $this->body;
    }

    public function info(int $id, int $page = null): \stdClass
    {
        $info       = $this->adapter->get($this->url.'info/'.$id, ['page' => $page, 'json' => true]);
        $this->body = json_decode($info->getBody());

        return (object) $this->body;
    }

    public function fans(int $id, int $uid = null): \stdClass
    {
        $this->url = 'http://public.service.kugou.com/user/singer';
        $fans      = $this->adapter->get($this->url, [
            'action' => 'getfansnum',
            'uid' => $uid,
            'singerid' => $id,
            'json'=>true
        ]);
        $this->body = json_decode($fans->getBody());

        return (object) $this->body;
    }
}
