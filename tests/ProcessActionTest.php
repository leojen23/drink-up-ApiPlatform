<?php 

use App\Entity\GardenerPlant;
use App\Entity\Plant;
use App\Entity\Watering;
use App\handlers\Actions\IAction;
use App\handlers\Actions\ProcessLocationAction;
use App\handlers\Actions\ProcessSeasonAction;
use App\handlers\Actions\ProcessSizeAction;
use App\handlers\Actions\ProcessSunlightAction;
use App\handlers\Actions\ProcessTopographyAction;
use App\handlers\WateringActionProcessor;
use PHPUnit\Framework\TestCase;

class ProcessActionTest extends TestCase

{
    private $initialFrequency = 10;
   
    public function testGardenerPlantIsAnInstance(){
        $gardenerPlant = new GardenerPlant();
        $this->assertInstanceOf(GardenerPlant::class, $gardenerPlant);
    }

    public function testreturnedFrequencyIsBoolean() {
        $gardenerPlant =  new GardenerPlant();
        $gardenerPlant->setNickname('Mao');
        $gardenerPlant->setSunlight('Lumineux');
        $gardenerPlant->setSize('Petite');
        $gardenerPlant->setSeason('Hiver');
        $gardenerPlant->setTopography('Montagne');
        $gardenerPlant->setLocation('Interieur');
        $action = new ProcessSizeAction();
        $frequency = $action->process($this->initialFrequency, $gardenerPlant );

        $this->assertIsInt($frequency);
    }
    public function testProcessSizeActionReturnsCorrectValue(){

        $gardenerPlant =  new GardenerPlant();
        $gardenerPlant->setSize('Grande');
        $action = new ProcessSizeAction();
        $frequency = $action->process($this->initialFrequency, $gardenerPlant );

        $this->assertSame(13, $frequency);
    }
    public function testProcessSeasonActionReturnsCorrectValue(){

        $gardenerPlant =  new GardenerPlant();
        $gardenerPlant->setSeason('Eté');
        $action = new ProcessSeasonAction();
        $frequency = $action->process($this->initialFrequency, $gardenerPlant );

        $this->assertSame(6, $frequency);
    }
    public function testProcessLocationActionReturnsCorrectValue(){

        $gardenerPlant =  new GardenerPlant();
        $gardenerPlant->setLocation('Extérieur');
        $action = new ProcessLocationAction();
        $frequency = $action->process($this->initialFrequency, $gardenerPlant );

        $this->assertSame(7, $frequency);
    }

    public function testProcessSunlightActionReturnsCorrectValue(){

        $gardenerPlant =  new GardenerPlant();
        $gardenerPlant->setSunlight('Lumineux');
        $action = new ProcessSunlightAction();
        $frequency = $action->process($this->initialFrequency, $gardenerPlant );

        $this->assertSame(9, $frequency);
    }
    public function testProcessTopographyActionReturnsCorrectValue(){

        $gardenerPlant =  new GardenerPlant();
        $gardenerPlant->setTopography('Bord de mer');
        $action = new ProcessTopographyAction();
        $frequency = $action->process($this->initialFrequency, $gardenerPlant );

        $this->assertSame(8, $frequency);
    }
   

}
