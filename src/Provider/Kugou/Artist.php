<?php

namespace Teakowa\Octo\Provider\Kugou;

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Kugou;

/**
 * Class Artist.
 */
class Artist extends Kugou
{
    /**
     * @var
     */
    private $body;
    /**
     * @var int
     */
    private $id;

    /**
     * Artist constructor.
     *
     * @param \Teakowa\Octo\Adapter\Adapter $adapter
     * @param int|null                      $id
     */
    public function __construct(Adapter $adapter, int $id = null)
    {
        parent::__construct($adapter);
        $this->id = $id;
    }

    /**
     * @return \stdClass
     */
    public function class(): \stdClass
    {
        $class = $this->adapter->get($this->url.'singer/class', ['json' => true], $this->header);
        $this->body = json_decode($class->getBody());

        return (object) $this->body;
    }

    /**
     * @param int      $id
     * @param int|null $page
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
     * @param int|null $page
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
     * @param int|null $uid
     *
     * @return \stdClass
     */
    public function fans(int $uid = null): \stdClass
    {
        $this->url = 'http://public.service.kugou.com/user/singer';
        $fans = $this->adapter->get($this->url, [
            'action'   => 'getfansnum',
            'uid'      => $uid,
            'singerid' => $this->id,
            'json'     => true,
        ], $this->header);
        $this->body = json_decode($fans->getBody());

        return (object) $this->body;
    }
}
