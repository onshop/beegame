<?php
namespace Game\Bee;

class Worker extends AbstractBee
{
    protected $lifeSpan = 75;

    protected $hitDeduction = 10;

    protected $type = 'Worker';

}