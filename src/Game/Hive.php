<?php

namespace Game;

use Game\Bee\AbstractBee;
use Game\Bee\Drone;
use Game\Bee\Worker;
use Game\Bee\Queen;

class Hive
{
    private $beeCollection = [];

    private $beeIndex;

    public function add($beeType, $quantity)
    {
        foreach (range(1, $quantity) as $i) {

            switch (strtolower($beeType)) {
                case 'drone':
                    $bee = new Drone();
                    break;
                case 'worker':
                    $bee = new Worker();
                    break;
                case 'queen':
                    $bee = new Queen();
                    break;
                default:
                    throw new \Exception($beeType . ' is not known');
            }

            $this->beeCollection[] = $bee;
        }
    }

    /**
     * @return int
     */
    public function getBeesRemaining()
    {
        return count($this->beeCollection);
    }

    /**
     * @return int|mixed
     */
    public function getRemainingLifeSpan()
    {
        $remainingLifeSpan = 0;
        /** @var AbstractBee $bee */
        foreach ($this->beeCollection as $index => $bee){
            $remainingLifeSpan += $bee->getLifeSpan();
            //echo $index . " " . $remainingLifeSpan . " " . $bee->getLifeSpan() . "\n";
        }

        return $remainingLifeSpan;
    }

    /**
     * @return bool
     */
    public function isHiveDead()
    {
        return $this->getBeesRemaining() < 1;
    }

    /**
     *
     */
    public function hitBee()
    {
        $bee = $this->selectRandomBee();

        $currentBeeLife = $bee->getLifeSpan();

        $bee->hit();

        if($bee->isDead()){


            unset($this->beeCollection[$this->beeIndex]);

            if($bee instanceof Queen){
                $this->beeCollection = [];
            }
        }

        return "You hit a " . $bee->getType() . " bee. Current hive lifespan of $currentBeeLife has been reduced by " . $bee->getHitDeduction() . " to " . $bee->getLifeSpan() . ". The remaining hive lifespan is " . $this->getRemainingLifeSpan();
    }

    /**
     * @return AbstractBee
     */
    public function selectRandomBee()
    {
        $this->beeIndex = array_rand($this->beeCollection, 1);

        return $this->beeCollection[$this->beeIndex];
    }


}