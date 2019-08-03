<?php

namespace Teakowa\Octo\Provider\Tencent;

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Tencent;

/**
 * Class Song.
 */
class Song extends Tencent
{
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var string|null
     */
    private $mid;

    /**
     * Song constructor.
     *
     * @param  \Teakowa\Octo\Adapter\Adapter  $adapter
     * @param  int|null  $id
     * @param  string|null  $mid
     */
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
     * @return object
     */
    public function info(): \stdClass
    {
        $result     = $this->adapter->get($this->url.'v8/fcg-bin/fcg_play_single_song.fcg', [
            'songid'   => $this->id,
            'songmid'  => $this->mid,
            'platform' => 'yqq',
            'format'   => 'json',
        ], $this->header);
        $this->body = json_decode($result->getBody());

        return (object) $this->body;
    }

    /**
     * This code source from https://github.com/metowolf/Meting/blob/master/src/Meting.php#L1005-L1075
     * ❤️ Thanks.
     *
     * @param  int  $br
     *
     * @return \stdClass
     */
    public function url(int $br = 320): \stdClass
    {
        $result = $this->adapter->get($this->url.'v8/fcg-bin/fcg_play_single_song.fcg', [
            'songid'   => $this->id,
            'songmid'  => $this->mid,
            'platform' => 'yqq',
            'format'   => 'json',
        ], $this->header);
        $data   = json_decode($result->getBody(), true);

        $guid = mt_rand() % 10000000000;
        $type = [
            ['size_320mp3', 320, 'M800', 'mp3'],
            ['size_192aac', 192, 'C600', 'm4a'],
            ['size_128mp3', 128, 'M500', 'mp3'],
            ['size_96aac', 96, 'C400', 'm4a'],
            ['size_48aac', 48, 'C200', 'm4a'],
            ['size_24aac', 24, 'C100', 'm4a'],
        ];
        $payload = [
            'req_0' => [
                'module' => 'vkey.GetVkeyServer',
                'method' => 'CgiGetVkey',
                'param'  => [
                    'guid'      => (string) $guid,
                    'songmid'   => [],
                    'filename'  => [],
                    'songtype'  => [],
                    'uin'       => '0',
                    'loginflag' => 1,
                    'platform'  => '20',
                ],
            ],
        ];

        foreach ($type as $vo) {
            $payload['req_0']['param']['songmid'][] = $data['data'][0]['mid'];
            $payload['req_0']['param']['filename'][] = $vo[2].$data['data'][0]['file']['media_mid'].'.'.$vo[3];
            $payload['req_0']['param']['songtype'][] = $data['data'][0]['type'];
        }

        $result = $this->adapter->get('https://u.y.qq.com/cgi-bin/musicu.fcg', [
            'format'      => 'json',
            'platform'    => 'yqq.json',
            'needNewCode' => 0,
            'data'        => json_encode($payload),
        ], $this->header);

        $response = json_decode($result->getBody(), true);
        $vkeys = $response['req_0']['data']['midurlinfo'];
        foreach ($type as $index => $vo) {
            if ($data['data'][0]['file'][$vo[0]] && $vo[1] <= $br) {
                if (!empty($vkeys[$index]['vkey'])) {
                    $url = [
                        'url'  => $response['req_0']['data']['sip'][0].$vkeys[$index]['purl'],
                        'size' => $data['data'][0]['file'][$vo[0]],
                        'br'   => $vo[1],
                    ];
                    break;
                }
            }
        }
        if (!isset($url['url'])) {
            $url = [
                'url'  => '',
                'size' => 0,
                'br'   => -1,
            ];
        }

        return (object) $url;
    }
}
