<?php

namespace AppBundle\Tests;

use AppBundle\Service\Game;

class GameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid argument x = 5 or y = 5
     */
    public function setInvalidFirstPoints()
    {
        $game = new Game();
        $game->setFirstPoint(5, 5);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage First you need to setFirstPoint
     */
    public function captureWithoutFirstPointException()
    {
        $game = new Game();
        $game->capture();
    }

    /**
     * @test
     */
    public function capture()
    {
        $game = new Game();
        $game->setFirstPoint(1, 1);
        $game->capture();
        $this->assertEquals($game->getResult(), 5);

        $game = new Game();
        $game->setFirstPoint(2, 2);
        $game->capture();
        $this->assertEquals($game->getResult(), 4);

        $game = new Game();
        $game->setFirstPoint(3, 3);
        $game->capture();
        $this->assertEquals($game->getResult(), 6);

        $game = new Game();
        $game->setFirstPoint(3, 4);
        $game->capture();
        $this->assertEquals($game->getResult(), 7);

        $game = new Game();
        $game->setFirstPoint(1, 4);
        $game->capture();
        $this->assertEquals($game->getResult(), 6);
    }
}
