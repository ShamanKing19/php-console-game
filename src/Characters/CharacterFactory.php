<?php

namespace App\Characters;

use App\Abilities\Batarang;
use App\Abilities\GreatRussianShelling;
use App\Abilities\FistPunch;
use App\Abilities\LegPunch;
use App\Abilities\SlavicEggClamp;
use App\Abilities\SpitToTheFace;
use App\Characters\Enemies\Lizard;
use App\Characters\Heroes\AncientRus;
use App\Characters\Heroes\Batman;
use App\Characters\Heroes\Spiderman;
use App\Enums\CharacterTypes;

class CharacterFactory
{
    /**
     * Древний Рус
     *
     * @return AncientRus
     */
    public function createAncientRus() : AncientRus
    {
        return new AncientRus(CharacterTypes::HERO, 9999, 5000, [
            new FistPunch(1000, 0),
            new LegPunch(5000, 0),
            new SlavicEggClamp(9999, 500),
            new GreatRussianShelling(5000, 1000)
        ]);
    }

    /**
     * Бэтмен
     *
     * @return Batman
     */
    public function createBatman() : Batman
    {
        return new Batman(CharacterTypes::HERO, 2000, 2000, [
            new FistPunch(100, 0),
            new LegPunch(300, 0),
            new Batarang(300,  100, 5)
        ]);
    }

    /**
     * Человек-паук
     *
     * @return Spiderman
     */
    public function createSpiderMan() : Spiderman
    {
        return new Spiderman(CharacterTypes::HERO, 3000, 1000, [
            new FistPunch(200, 0),
            new LegPunch(400, 0),
        ]);
    }

    /**
     * Ящер
     *
     * @return Lizard
     */
    public function createLizard() : Lizard
    {
        return new Lizard(CharacterTypes::ENEMY, 5000, 4000, [
            new SpitToTheFace(100, 0)
        ]);
    }
}