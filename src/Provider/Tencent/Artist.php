<?php

namespace Teakowa\Octo\Provider\Tencent;

use Teakowa\Octo\Provider\Tencent;

/**
 * Class Artist.
 */
class Artist extends Tencent
{
    /**
     * @var
     */
    private $body;

    /**
     * @param int|null    $id
     * @param string|null $mid
     * @param int         $limit
     *
     * @return \stdClass
     */
    public function info(int $id = null, string $mid = null, int $limit = 20): \stdClass
    {
        $result = $this->adapter->get($this->url.'v8/fcg-bin/fcg_v8_singer_track_cp.fcg', [
            'singerid'  => $id,
            'singermid' => $mid,
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
     * @param int|null    $id
     * @param string|null $mid
     *
     * @return \stdClass
     */
    public function fans(int $id = null, string $mid = null): \stdClass
    {
        $result = $this->adapter->get($this->url.'rsc/fcgi-bin/fcg_order_singer_getnum.fcg', [
            'singerid'  => $id,
            'singermid' => $mid,
            'format'    => 'json',
        ], $this->header);

        $this->body = json_decode($result->getBody());

        return (object) $this->body;
    }

    /**
     * @param string|null $mid
     * @param int         $size
     *
     * @return \stdClass
     */
    public function pic(string $mid = null, int $size = 300): \stdClass
    {
        $url = 'https://y.gtimg.cn/music/photo_new/T001R'.$size.'x'.$size.'M000'.$mid.'.jpg?max_age=2592000';

        return (object) ['url' => $url];
    }
}
