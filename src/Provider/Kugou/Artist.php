<?php

namespace Teakowa\Octo\Provider\Kugou;

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Adapter\Headers;
use Teakowa\Octo\Provider\Interfaces\Artist as API;

/**
 * Class Artist.
 */
final class Artist implements API
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var \Teakowa\Octo\Adapter\Adapter
     */
    private $adapter;
    /**
     * @var array
     */
    private $header;
    /**
     * @var string
     */
    private $url = 'http://m.kugou.com/';
    /**
     * @var
     */
    private $body;

    /**
     * Artist constructor.
     *
     * @param  \Teakowa\Octo\Adapter\Adapter  $adapter
     * @param  int|null  $id
     */
    public function __construct(Adapter $adapter, int $id = null)
    {
        $this->adapter = $adapter;
        $this->header = (new Headers())->getProvider('Kugou');
        $this->id = $id;
    }

    /**
     * Get artist class.
     *
     * @return \stdClass
     */
    public function class(): \stdClass
    {
        $class = $this->adapter->get($this->url.'singer/class', ['json' => true], $this->header);
        $this->body = json_decode($class->getBody());

        return (object) $this->body;
    }

    /**
     * Get artist list by class id.
     *
     * @param  int  $id
     * @param  int|null  $page
     *
     * @return \stdClass
     */
    public function list(int $id, int $page = null): \stdClass
    {
        $list = $this->adapter->get($this->url.'singer/list/'.$id, [
            'page' => $page, 'json' => true,
        ], $this->header);
        $this->body = json_decode($list->getBody());

        return (object) $this->body;
    }

    /**
     * Get artist info by artist id.
     *
     * @param  int|null  $page
     *
     * @return \stdClass
     */
    public function info(int $page = null): \stdClass
    {
        $info = $this->adapter->get($this->url.'singer/info/'.$this->id, [
            'page' => $page, 'json' => true,
        ], $this->header);
        $this->body = json_decode($info->getBody());

        return (object) $this->body;
    }

    /**
     * Get artist fans by artist id.
     *
     * @param  int|null  $uid  user id, it's will return 'follow' Boolean field.
     *
     * @return \stdClass
     */
    public function fans(int $uid = null): \stdClass
    {
        $this->url = 'http://public.service.kugou.com/user/singer';
        $fans = $this->adapter->get($this->url, [
            'action' => 'getfansnum',
            'uid' => $uid,
            'singerid' => $this->id,
            'json' => true,
        ], $this->header);
        $this->body = json_decode($fans->getBody());

        return (object) $this->body;
    }

    /**
     * Get artist avatar url.
     *
     * @param  int  $size
     *
     * @return \stdClass
     *
     * @since 1.2.1
     */
    public function pic(int $size = 300): \stdClass
    {
        $result = $this->adapter->get($this->url.'singer/info/'.$this->id, ['json' => true], $this->header);
        $this->body = json_decode($result->getBody());

        $url = ! empty($this->body->info->imgurl) ? str_replace('{size}', 240, $this->body->info->imgurl) : null;

        return (object) ['url' => $url];
    }
}
