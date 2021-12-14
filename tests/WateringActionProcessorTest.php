<?php

use App\Entity\GardenerPlant;
use App\Entity\Plant;
use App\handlers\Actions\ProcessSeasonAction;
use App\handlers\Actions\ProcessSizeAction;
use App\handlers\WateringActionProcessor;
use PHPUnit\Framework\TestCase;

class WateringActionProcessorTest extends TestCase
{

    public function testActionsIsAnArray() 
    {
        $processor = new WateringActionProcessor();
        $sizeAction = new ProcessSizeAction;
        $processor->addAction( $sizeAction);
        $this->assertIsArray($processor->getActions());

    }
    public function testActionsAreAddedToArray() 
    {
        $processor = new WateringActionProcessor();
        $sizeAction = new ProcessSizeAction;
        $seasonAction = new ProcessSeasonAction;
        $processor->addAction( $sizeAction);
        $processor->addAction( $seasonAction);
        $this->assertCount(2, $processor->getActions());
    }
    public function testFrequencyValueIsProcessedAndPassedOn() 
    {
        $initialFrequency = 10;
        $plant = new Plant();
        $plant->setFrequency(10);
        $gardenerPlant = new GardenerPlant();
        $gardenerPlant->setSize('Petite');
        $gardenerPlant->setSeason('Hiver');
        $gardenerPlant->setPlant($plant);

        $processor = new WateringActionProcessor();
        $sizeAction = new ProcessSizeAction;
        $seasonAction = new ProcessSeasonAction;
        $processor->addAction( $sizeAction);
        $processor->addAction( $seasonAction);

        $processor->setGardenerPlant($gardenerPlant);
        $frequency =  $processor->process($initialFrequency, 
        $gardenerPlant);
        $this->assertSame(7, $frequency);
    }
}
