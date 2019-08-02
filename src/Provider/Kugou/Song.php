<?php

namespace Teakowa\Octo\Provider\Kugou;

use Teakowa\Octo\Provider\Kugou;

class Song extends Kugou
{
    private $url;
    private $adapter;
    private $body;

    public function __construct(Adapter $adapter)
    {
        $this->url = 'http://m.kugou.com/';
        $this->adapter = $adapter;
    }

    public function new(): \stdClass
    {
        $new = $this->adapter->get($this->url, ['json' => true]);
        $this->body = json_decode($new->getBody());

        return (object) $this->body;
    }

    public function info(string $hash): \stdClass
    {
        $info = $this->adapter->get($this->url.'app/i/getSongInfo.php', ['cmd' => 'playInfo', 'hash' => $hash]);
        $this->body = json_decode($info->getBody());

        return (object) $this->body;
    }

    public function special(string $hash): \stdClass
    {
        $this->url = 'http://servicebj.mobile.kugou.com/v1/yueku/special_album_recommend';
        $special = $this->adapter->get($this->url, ['hash' => $hash, 'api_ver' => 2]);
        $this->body = json_decode($special->getBody());

        return (object) $this->body;
    }
}
