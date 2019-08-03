<?php

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Tencent;

class TencentAlbumTestTest extends TestCase
{
    public function testAlbum()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Tencent/album.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $tencent = new Tencent($mock);
        $result = $tencent->album(7264512)->info();

        $this->assertObjectHasAttribute('list', $result->data);
    }
}
