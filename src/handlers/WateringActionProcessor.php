<?php 
namespace App\handlers;

use App\Entity\GardenerPlant;
use App\handlers\Actions\IAction;

class WateringActionProcessor{

    protected array $actions = [];
    protected GardenerPlant $gardenerPlant;

    public function __construct()
    {}

    public function getActions(){
        return $this->actions;
    }

    public function addAction(IAction $action)
    {
        $this->actions[] = $action;
        return $this;
    }

    public function setGardenerPlant(GardenerPlant $gardenerPlant):WateringActionProcessor
    {
        $this->gardenerPlant = $gardenerPlant;
        return $this;
    }
    
    protected function getGardenerPlant():GardenerPlant
    {
        return $this->gardenerPlant;
    }

    public function process():int
    {
        $gardenerPlant = $this->getGardenerPlant();
        $frequency = $gardenerPlant->getPlant()->getFrequency();

        foreach ($this->actions as $action){

            $frequency = $action->process($frequency, $gardenerPlant);
        }

        return $frequency;
    }

}