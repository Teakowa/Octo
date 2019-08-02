<?php

namespace Teakowa\Octo\Provider;

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Kugou\Artist;
use Teakowa\Octo\Provider\Kugou\Song;
use Teakowa\Octo\Traits\BodyAccessorTrait;

/**
 * Class Kugou.
 */
class Kugou implements API
{
    use BodyAccessorTrait;
    /**
     * @var \Teakowa\Octo\Adapter\Adapter
     */
    protected $adapter;
    /**
     * @var string
     */
    protected $url = 'http://m.kugou.com/';
    /**
     * @var array
     */
    protected $header;

    /**
     * Kugou constructor.
     *
     * @param \Teakowa\Octo\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->header  = [
            'User-Agent'    => 'IPhone-8990-searchSong',
            'UNI-UserAgent' => 'iOS11.4-Phone8990-1009-0-WiFi',
        ];
    }

    /**
     * @return \Teakowa\Octo\Provider\Kugou\Artist
     */
    public function artist()
    {
        return new Artist($this->adapter);
    }

    /**
     * @return \Teakowa\Octo\Provider\Kugou\Song
     */
    public function song()
    {
        return new Song($this->adapter);
    }

    public function album(int $id): \stdClass
    {
        $url = 'http://m.kugou.com/app/i/getablum.php';
        $album = $this->adapter->get($url, ['type' => 1, 'ablumid' => $id]);
        $this->body = json_decode($album->getBody());

        return (object) $this->body;
    }

    public function search(string $keyword, int $page = null): \stdClass
    {
        $url = 'http://songsearch.kugou.com/song_search_v2';
        $result = $this->adapter->get($url, ['keyword' => $keyword, 'page' => $page]);
        $this->body = json_decode($result->getBody());

        return (object) $this->body;
    }
}
