<?php

namespace App\handlers\Actions;

use App\Entity\GardenerPlant;
use App\handlers\Actions\IAction;

class ProcessSunlightAction implements IAction {

   
    public function process(int $frequency, GardenerPlant $gardenerPlant):int
    {
        $sunlight = $gardenerPlant->getSunlight();
        
        switch ($sunlight) {
            case 'Ombragé':
                return $frequency;
                break;
            case 'Lumineux':
                return $frequency -= $frequency * 10/100;
                break;
            case 'Très Lumineux':
                return $frequency -= $frequency * 20/100;
                break;
            default:
                return $frequency;
                break;
        }
    }
}


