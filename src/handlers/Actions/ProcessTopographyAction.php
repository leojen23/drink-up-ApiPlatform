<?php

namespace App\handlers\Actions;

use App\Entity\GardenerPlant;
use App\handlers\Actions\IAction;

class ProcessTopographyAction implements IAction {

   
    public function process(int $frequency, GardenerPlant $gardenerPlant):int
    {
        
        $topography = $gardenerPlant->getTopography();
  
        switch ($topography) {
            case 'Bord de mer':
                return $frequency -= $frequency * 20/100;
                break;
            case 'Plaine':
                return $frequency += $frequency * 10/100;
                break;
            case 'Plateau':
                return $frequency += $frequency * 10/100;
                break;
            case 'Montagne':
                return $frequency += $frequency * 20/100;
                break;
            default:
                return $frequency;
                break;
        }
    }
}


