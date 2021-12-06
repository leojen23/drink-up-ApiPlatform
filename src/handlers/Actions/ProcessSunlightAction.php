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
                return $frequency + ($frequency + 1);
                break;
            case 'Lumineux':
                return $frequency;
                break;
            case 'Très Lumineux':
                return $frequency - ($frequency - 1);
                break;
            default:
                return $frequency;
                break;
        }
    }
}


