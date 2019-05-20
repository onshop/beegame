<?php
namespace Tests\Game;

use PHPUnit\Framework\TestCase;

class HiveTest extends TestCase
{
    public function testHiveAdd()
    {
        $hive = $this->getHive();
        $hive->add("Queen", 4);
        $hive->add("Worker", 2);
        $hive->add("Drone", 5);
        $this->assertCount(11, $hive->getBeeCollection());
    }

    public function testHiveAddNotAnInteger()
    {
        $hive = $this->getHive();
        $this->expectException("InvalidArgumentException");
        $hive->add("Queen", 0);
    }

    public function testHiveAddUnknownBeeType()
    {
        $hive = new \Game\Hive();
        $this->expectException("UnexpectedValueException");
        $hive->add("King", 4);
    }

    public function testGetBeesRemaining()
    {
        $hive = $this->getHive();
        $hive->add("Queen", 1);
        $hive->add("Worker", 3);
        $hive->add("Drone", 2);
        $this->assertEquals(6, $hive->getTotalBeesRemaining());
    }

    public function testRemainingLifeSpan()
    {
        $hive = $this->getHive();
        $hive->add("Queen", 2);
        $hive->add("Worker", 6);
        $hive->add("Drone", 1);
        $this->assertEquals(700, $hive->getRemainingLifeSpan());
    }

    public function testHitBee()
    {
        $hive = $this->getHive();
        $hive->add("Drone", 1);
        $output = $hive->hitBee();
        $this->assertEquals($output, sprintf($hive::$outputMsg, 'Drone', 50, 12, 38, 38));
    }

    public function hitBeeIsRemoved()
    {
        $hive = $this->getHive();
        $hive->add("Drone", 1);
        $drone = $hive->selectBee();
        $drone->setLifeSpan(12);
        $hive->add("Worker", 6);
        $this->assertCount(7, $hive->getBeeCollection());
        $hive->hitBee($hive->getBeeCurrentIndex());
        $this->assertCount(6, $hive->getBeeCollection());
    }

    public function testHitQueenThatDies()
    {
        $hive = $this->getHive();
        $hive->add("Queen", 1);
        $queen = $hive->selectBee();
        $queen->setLifeSpan(8);
        $hive->add("Drone", 4);
        $this->assertCount(5, $hive->getBeeCollection());
        $hive->hitBee($hive->getBeeCurrentIndex());
        $this->assertCount(0, $hive->getBeeCollection());
    }

    /**
     * @return \Game\Hive
     */
    private function getHive(): \Game\Hive
    {
        $hive = new \Game\Hive();
        $this->assertCount(0, $hive->getBeeCollection());
        return $hive;
    }

}