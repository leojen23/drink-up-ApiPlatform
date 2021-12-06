<?php

use App\Entity\GardenerPlant;
use App\handlers\Actions\ProcessLocationAction;
use App\handlers\Actions\ProcessSeasonAction;
use App\handlers\Actions\ProcessSizeAction;
use App\handlers\Actions\ProcessSunlightAction;
use App\handlers\Actions\ProcessTopographyAction;
use App\handlers\WateringActionProcessor;

class WateringHandler  {


    protected WateringActionProcessor $wateringActionProcessor;
   

    public function __construct(WateringActionProcessor $wateringActionProcessor)
    {
        $this->wateringActionProcessor = $wateringActionProcessor;
        $this->wateringActionProcessor->addAction(new ProcessSizeAction());
        $this->wateringActionProcessor->addAction(new ProcessSunlightAction());
        $this->wateringActionProcessor->addAction(new ProcessSeasonAction());
        $this->wateringActionProcessor->addAction(new ProcessTopographyAction());
        $this->wateringActionProcessor->addAction(new ProcessLocationAction());
    }
    /**
     * @param int 
     */
    public function process(GardenerPlant $gardenerPlant):int
    {
        return $this->wateringActionProcessor
            ->setGardenerPlant($gardenerPlant)
            ->process();
    }

}




















