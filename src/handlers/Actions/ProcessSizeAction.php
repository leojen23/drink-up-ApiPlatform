<?php

namespace App\handlers\Actions;

use App\Entity\GardenerPlant;
use App\handlers\Actions\IAction;

class ProcessSizeAction implements IAction {

    public function process(int $frequency, GardenerPlant $gardenerPlant):int
    {
        $size = $gardenerPlant->getSize();
        // dd($size);
        switch ($size) {
            case 'Petite':
                return $frequency -= $frequency * 50/100;
                break;
            case 'Moyenne':
                return $frequency;
                break;
            case 'Grande':
                return $frequency += $frequency * 30/100;
                break;
            default:
                return $frequency;
                break;
        }
    }
}


