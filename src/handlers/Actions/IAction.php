<?php 
namespace App\handlers\Actions;

use App\Entity\GardenerPlant;

interface IAction{
    public function process(int $frequency, GardenerPlant $gardenerPlant):int;
}