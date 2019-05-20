<?php
namespace Tests\Game;

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase{

    public function testHandleCommand()
    {
        $hive = $this->createMock(\Game\Hive::class);
        $hive->method('hitBee')
             ->willReturn('foo');

        $game = new \Game\Game($hive);
        $output = $game->handleCommand('hit');
        $this->assertEquals('foo', $output);
    }

    public function testHandleUnknownCommand()
    {
        $hive = $this->createMock(\Game\Hive::class);
        $game = new \Game\Game($hive);
        $this->expectException('UnexpectedValueException');
        $game->handleCommand('whack');
    }

    public function testIsGameOver()
    {
        $hive = $this->createMock(\Game\Hive::class);
        $hive->method('isHiveDead')
             ->willReturn(true);

        $game = new \Game\Game($hive);
        $output = $game->isGameOver();
        $this->assertEquals(true, $output);
    }

}