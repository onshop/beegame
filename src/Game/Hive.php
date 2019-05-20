<?php

namespace Game;

use Game\Bee\AbstractBee;
use Game\Bee\Drone;
use Game\Bee\Worker;
use Game\Bee\Queen;

/**
 * Class Hive
 * @package Game
 */
class Hive
{
    private $beeCollection = [];

    private $beeIndex;

    static $outputMsg = "You hit a %s bee. Current hive lifespan of %s has been reduced by %d to %d. The remaining hive lifespan is %d.";

    public function add($beeType, $quantity): Hive
    {
        if ($quantity < 1) {
            throw new \InvalidArgumentException('Bee total is not an integer');
        }

        foreach (range(1, $quantity) as $i) {

            switch (strtolower($beeType)) {
                case "drone":
                    $bee = new Drone();
                    break;
                case "worker":
                    $bee = new Worker();
                    break;
                case "queen":
                    $bee = new Queen();
                    break;
                default:
                    throw new \UnexpectedValueException("$beeType is not known");
            }

            $this->beeCollection[] = $bee;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getBeeCollection(): array
    {
        return $this->beeCollection;
    }

    /**
     * @return int
     */
    public function getTotalBeesRemaining(): int
    {
        return count($this->beeCollection);
    }

    /**
     * @return int
     */
    public function getRemainingLifeSpan(): int
    {
        $remainingLifeSpan = 0;

        /** @var AbstractBee $bee */
        foreach ($this->beeCollection as $index => $bee) {
            $remainingLifeSpan += $bee->getLifeSpan();
        }

        return $remainingLifeSpan;
    }

    /**
     * @return bool
     */
    public function isHiveDead(): bool
    {
        return $this->getTotalBeesRemaining() < 1;
    }

    /**
     * @param null $index
     * @return string
     */
    public function hitBee($index = null): string
    {
        $bee = $this->selectBee($index);

        $currentBeeLife = $bee->getLifeSpan();

        $bee->hit();

        if ($bee->isDead()) {
            unset($this->beeCollection[$this->beeIndex]);

            if ($bee instanceof Queen) {
                $this->beeCollection = [];
            }
        }

        return sprintf($this::$outputMsg, $bee->getType(), $currentBeeLife, $bee->getHitDeduction(), $bee->getLifeSpan(), $this->getRemainingLifeSpan());
    }

    /**
     * @param null $index
     * @return AbstractBee
     */
    public function selectBee($index = null): AbstractBee
    {
        if (is_null($index)) {
            $index = array_rand($this->beeCollection, 1);
        }

        $this->beeIndex = $index;

        return $this->beeCollection[$index];
    }

    /**
     * @return int
     */
    public function getBeeCurrentIndex(): int
    {
        return $this->beeIndex;
    }


}