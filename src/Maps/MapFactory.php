<?php

namespace App\Maps;

use App\Characters\CharacterFactory;

class MapFactory
{
    public function createTrainingMap() : TrainingMap
    {
        $characterFactory = new CharacterFactory();

        return new TrainingMap([
            $characterFactory->createLizard(),
            $characterFactory->createLizard(),
            $characterFactory->createLizard(),
        ]);
    }
}