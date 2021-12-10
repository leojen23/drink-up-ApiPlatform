<?php

namespace App\handlers\Actions;

use App\Entity\GardenerPlant;
use App\handlers\Actions\IAction;

class ProcessLocationAction implements IAction {

   
    public function process(int $frequency, GardenerPlant $gardenerPlant):int
    {
        $location = $gardenerPlant->getLocation();

        switch ($location) {
            case 'Intérieur':
                return $frequency -= $frequency * 10/100;
                break;
            case 'Extérieur':
                return $frequency -= $frequency * 25/100;
                break;
            default:
                return $frequency;
                break;
        }
    }
}


