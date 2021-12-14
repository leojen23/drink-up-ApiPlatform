<?php

namespace App\handlers\Actions;

use App\Entity\GardenerPlant;
use App\handlers\Actions\IAction;

class ProcessSeasonAction implements IAction {

    public function process(int $frequency, GardenerPlant $gardenerPlant):int
    {
        $season = $gardenerPlant->getSeason();
        
        switch ($season) {
            case 'Printemps':
                return $frequency ;
                break;
            case 'Eté':
                return $frequency -= $frequency * 40/100;
                break;
            case 'Automne':
                return $frequency -= $frequency * 25/100;
                break;
            case 'Hiver':
                return $frequency += $frequency * 50/100;
                break;
            default:
                return $frequency;
                break;
        }
    }
}


