<?php

namespace App\Maps;

use App\Characters\CharacterFactory;
use App\Maps\Objects\ObjectFactory;

class MapFactory
{
    public function createTrainingMap() : TrainingMap
    {
        $characterFactory = new CharacterFactory();
        $mapObjectsFactory = new ObjectFactory();

        return new TrainingMap(
            [
                $characterFactory->createLizard(),
                $characterFactory->createLizard(),
                $characterFactory->createLizard(),
            ],
            [
                $mapObjectsFactory->createExplosiveBarrel(),
                $mapObjectsFactory->createExplosiveBarrel(),
                $mapObjectsFactory->createHealingFruit(),
                $mapObjectsFactory->createHealingFruit()
            ]
        );
    }
}