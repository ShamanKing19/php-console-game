<?php

namespace App\Maps\Objects;

use App\Enums\MapObjectEffect;
use App\Enums\MapObjectEffectType;

class ObjectFactory
{
    public function createExplosiveBarrel() : ExplosiveBarrel
    {
        return new ExplosiveBarrel(MapObjectEffect::DAMAGE, MapObjectEffectType::ALL, 1000);
    }

    public function createHealingFruit() : HealingFruit
    {
        return new HealingFruit(MapObjectEffect::HEALING, MapObjectEffectType::SINGLE, 2000);
    }
}