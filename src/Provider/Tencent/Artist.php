<?php

namespace Teakowa\Octo\Provider\Tencent;

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Tencent;

/**
 * Class Artist.
 */
class Artist extends Tencent
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $mid;

    public function __construct(Adapter $adapter, int $id = null, string $mid = null)
    {
        parent::__construct($adapter);
        $this->id  = $id;
        $this->mid = $mid;
    }

    /**
     * @var
     */
    private $body;

    /**
     * @param  int  $limit
     *
     * @return \stdClass
     */
    public function info(int $limit = 20): \stdClass
    {
        $result     = $this->adapter->get($this->url.'v8/fcg-bin/fcg_v8_singer_track_cp.fcg', [
            'singerid'  => $this->id,
            'singermid' => $this->mid,
            'begin'     => 0,
            'num'       => $limit,
            'order'     => 'listen',
            'platform'  => 'mac',
            'newsong'   => 1,
            'format'    => 'json',
        ], $this->header);
        $this->body = json_decode($result->getBody());

        return (object) $this->body;
    }

    /**
     * @return \stdClass
     */
    public function fans(): \stdClass
    {
        $result = $this->adapter->get($this->url.'rsc/fcgi-bin/fcg_order_singer_getnum.fcg', [
            'singerid'  => $this->id,
            'singermid' => $this->mid,
            'format'    => 'json',
        ], $this->header);

        $this->body = json_decode($result->getBody());

        return (object) $this->body;
    }

    /**
     * @param  int  $size
     *
     * @return \stdClass
     */
    public function pic(int $size = 300): \stdClass
    {
        $result     = $this->adapter->get($this->url.'v8/fcg-bin/fcg_v8_singer_track_cp.fcg', [
            'singerid'  => $this->id,
            'singermid' => $this->mid,
            'begin'     => 0,
            'num'       => 1,
            'order'     => 'listen',
            'platform'  => 'mac',
            'newsong'   => 1,
            'format'    => 'json',
        ], $this->header);
        $this->body = json_decode($result->getBody());

        $mid = ! empty($this->mid) ? $this->mid : $this->body->data->singer_mid;
        $url = 'https://y.gtimg.cn/music/photo_new/T001R'.$size.'x'.$size.'M000'.$mid.'.jpg?max_age=2592000';

        return (object) ['url' => $url];
    }
}
