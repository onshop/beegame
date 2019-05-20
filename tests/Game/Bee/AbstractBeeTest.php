<?php
namespace Tests\Game\Bee;

use Game\Bee\AbstractBee;
use PHPUnit\Framework\TestCase;

class AbstractBeeTest extends TestCase
{
    public function testHit()
    {
       /** @var AbstractBee $bee */
       $bee = $this->getMockForAbstractClass(\Game\Bee\AbstractBee::class);
       $bee->setLifeSpan(45);
       $bee->setHitDeduction(5);
       $bee->hit();
       $this->assertEquals(40, $bee->getLifeSpan());
    }

    public function testHitToDeath()
    {
        /** @var AbstractBee $bee */
        $bee = $this->getMockForAbstractClass(\Game\Bee\AbstractBee::class);
        $bee->setLifeSpan(4);
        $bee->setHitDeduction(5);
        $bee->hit();
        $this->assertEquals(0, $bee->getLifeSpan());
    }

}