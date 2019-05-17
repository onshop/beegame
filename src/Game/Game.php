<?php
namespace Game;

class Game {

    private $hive;

    /**
     * Game constructor.
     * @param Hive $hive
     */
    public function __construct(Hive $hive)
    {
        $this->hive = $hive;
    }

    /**
     * @param $command
     * @return string
     * @throws \Exception
     */
    public function handleCommand($command): string
    {

        switch ($command) {
            case 'hit':
                 return $this->hive->hitBee();
                break;
            default:
                throw new \Exception('Command not supported');
        }
    }

    /**
     * @return bool
     */
    public function isGameOver()
    {
        return $this->hive->isHiveDead();
    }


}