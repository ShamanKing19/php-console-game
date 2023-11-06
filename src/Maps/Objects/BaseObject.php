<?php

namespace App\Maps\Objects;

use App\Enums\MapObjectEffect;
use App\Enums\MapObjectEffectType;

abstract class BaseObject implements MapObject
{
    private int $id;
    protected string $name;
    private MapObjectEffect $effect;
    private MapObjectEffectType $type;
    private float $effectValue;
    private array $targets;

    public function __construct(MapObjectEffect $effect, MapObjectEffectType $type, float $effectValue)
    {
        $this->id = random_int(0, 9999999999);
        $this->effect = $effect;
        $this->type = $type;
        $this->effectValue = $effectValue;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getEffect() : MapObjectEffect
    {
        return $this->effect;
    }

    public function getType() : MapObjectEffectType
    {
        return $this->type;
    }

    public function getValue() : float
    {
        return $this->effectValue;
    }

    public function setTargets(array &$characters) : void
    {
        $this->targets = $characters;
    }

    public function getTargets() : array
    {
        return $this->targets;
    }

    public function trigger() : void
    {
        foreach($this->getTargets() as $target) {
            switch($this->getEffect()) {
                case MapObjectEffect::DAMAGE:
                    $target->removeHealth($this->getValue());
                    consoleLog('Персонажу "' . $target->getName() . '" нанесён урон в размере ' . $this->getValue());
                    break;
                case MapObjectEffect::HEALING:
                    $target->addHealth($this->getValue());
                    consoleLog('Персонажу "' . $target->getName() . '" восстановлено здоровье в размере ' . $this->getValue());
                    break;
            }
        }
    }
}