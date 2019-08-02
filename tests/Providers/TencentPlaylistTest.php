<?php

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Tencent;

class TencentPlaylistTest extends TestCase
{
    public function testPlaylist()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Tencent/playlist.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $tencent = new Tencent($mock);
        $result  = $tencent->playlist(7107630008);

        $this->assertObjectHasAttribute('songlist',$result->data->cdlist[0]);
    }
}