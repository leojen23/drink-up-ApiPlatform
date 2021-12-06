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
                return $frequency + 2;
                break;
            case 'Automne':
                return $frequency - 1;
                break;
            case 'Hiver':
                return $frequency - 3;
                break;
            default:
                return $frequency;
                break;
        }
    }
}


