<?php
namespace Game\Bee;

class Drone extends AbstractBee
{
    protected $lifeSpan = 50;

    protected $hitDeduction = 12;

    protected $type = 'Drone';

}