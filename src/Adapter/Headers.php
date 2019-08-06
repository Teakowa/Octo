<?php

namespace Teakowa\Octo\Adapter;

/**
 * Class Headers.
 */
class Headers implements Header
{
    /**
     * @var array
     */
    private $headers;

    /**
     * Headers constructor.
     *
     * @param array $headers [optional]
     */
    public function __construct(array $headers = [])
    {
        $this->headers = $headers;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param string $provider
     *
     * @return array
     *
     * @since 1.2.1
     */
    public function getProvider(string $provider): array
    {
        switch ($provider) {
            case 'Kugou':
                $this->headers =
                    ['User-Agent' => 'Mozilla/5.0 (Linux; Android 5.1; MZ-m1 metal Build/LMY47I) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0'];
                break;
            case 'Tencent':
                $this->headers = [
                    'Referer'         => 'https://y.qq.com/',
                    'Cookie'          => 'pgv_pvi=22038528; pgv_si=s3156287488; pgv_pvid=5535248600; yplayer_open=1; ts_last=y.qq.com/portal/player.html; ts_uid=4847550686; yq_index=0; qqmusic_fromtag=66; player_exist=1',
                    'User-Agent'      => 'QQ%E9%9F%B3%E4%B9%90/54409 CFNetwork/901.1 Darwin/17.6.0 (x86_64)',
                    'Accept'          => '*/*',
                    'Accept-Language' => 'zh-CN,zh;q=0.8,gl;q=0.6,zh-TW;q=0.4',
                    'Connection'      => 'keep-alive',
                    'Content-Type'    => 'application/x-www-form-urlencoded',
                ];
                break;
            case 'Netease':
                $this->headers = [
                    'Referer'         => 'https://music.163.com/',
                    'Cookie'          => 'appver=1.5.9; os=osx; __remember_me=true; osver=%E7%89%88%E6%9C%AC%2010.13.5%EF%BC%88%E7%89%88%E5%8F%B7%2017F77%EF%BC%89;',
                    'User-Agent'      => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_5) AppleWebKit/605.1.15 (KHTML, like Gecko)',
                    'X-Real-IP'       => long2ip(mt_rand(1884815360, 1884890111)),
                    'Accept'          => '*/*',
                    'Accept-Language' => 'zh-CN,zh;q=0.8,gl;q=0.6,zh-TW;q=0.4',
                    'Connection'      => 'keep-alive',
                    'Content-Type'    => 'application/x-www-form-urlencoded',
                ];
                break;
        }

        return $this->headers;
    }
}
