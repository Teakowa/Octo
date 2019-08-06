<?php

namespace Teakowa\Octo\Provider;

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Adapter\Headers;
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
        $this->header  = (new Headers())->getProvider('Kugou');
    }

    /**
     * @param int|null $id
     *
     * @return \Teakowa\Octo\Provider\Kugou\Artist
     */
    public function artist(int $id = null): Artist
    {
        return new Artist($this->adapter, $id);
    }

    /**
     * @param string|null $hash
     *
     * @return \Teakowa\Octo\Provider\Kugou\Song
     */
    public function song(string $hash = null): Song
    {
        return new Song($this->adapter, $hash);
    }

    /**
     * @param int $id
     *
     * @return \stdClass
     */
    public function album(int $id): \stdClass
    {
        $url = 'http://m.kugou.com/app/i/getablum.php';
        $album = $this->adapter->get($url, ['type' => 1, 'ablumid' => $id]);
        $this->body = json_decode($album->getBody());

        return (object) $this->body;
    }

    /**
     * @param string   $keyword
     * @param int|null $page
     *
     * @return \stdClass
     */
    public function search(string $keyword, int $page = null): \stdClass
    {
        $url = 'http://songsearch.kugou.com/song_search_v2';
        $result = $this->adapter->get($url, ['keyword' => $keyword, 'page' => $page]);
        $this->body = json_decode($result->getBody());

        return (object) $this->body;
    }
}
