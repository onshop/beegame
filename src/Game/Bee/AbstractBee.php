<?php
namespace Game\Bee;

abstract class AbstractBee{

    /**
     * @var int
     */
    protected $lifeSpan;

    /**
     * @var int
     */
    protected $hitDeduction;

    /**
     * @var string
     */
    protected $type;

    /**
     * @return int
     */
    public function getLifeSpan(): int
    {
        return $this->lifeSpan;
    }

    public function setLifeSpan($lifeSpan): AbstractBee
    {
        $this->lifeSpan = $lifeSpan;

        return $this;
    }

    /**
     * @return int
     */
    public function getHitDeduction(): int
    {
        return $this->hitDeduction;
    }

    /**
     * @param $hitDeduction
     * @return AbstractBee
     */
    public function setHitDeduction($hitDeduction): AbstractBee
    {
        $this->hitDeduction = $hitDeduction;

        return $this;
    }

    /**
     *
     */
    public function hit(): AbstractBee
    {
        $this->lifeSpan -= $this->getHitDeduction();

        if($this->lifeSpan < 0){
            $this->lifeSpan = 0;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function isDead(): bool
    {
        return ($this->lifeSpan < 1);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

}
