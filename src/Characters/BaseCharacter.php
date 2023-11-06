<?php

namespace App\Characters;

use App\Abilities\Ability;
use App\Enums\CharacterTypes;

class BaseCharacter implements Character
{
    /** @var string Название персонажа */
    public static string $name;

    private CharacterTypes $type;

    private float $maxHealth;
    private float $health;

    private float $maxMana;
    private float $mana;

    private array $abilities;


    public function __construct(CharacterTypes $type, int $maxHealth, int $maxMana, array $abilities = [])
    {
        $this->type = $type;

        $this->maxHealth = $maxHealth;
        $this->health = $maxHealth;

        $this->maxMana = $maxMana;
        $this->mana = $maxMana;

        $this->abilities = $abilities;
    }

    public function getName() : string
    {
        return static::$name;
    }

    public function getType() : CharacterTypes
    {
        return $this->type;
    }

    public function getMaxHealth() : float
    {
        return $this->maxHealth;
    }

    public function getHealth() : float
    {
        return $this->health;
    }

    public function getMaxMana() : float
    {
        return $this->maxMana;
    }

    public function getMana() : float
    {
        return $this->mana;
    }

    public function getAbilities() : array
    {
        return $this->abilities;
    }

    public function setHealth(float $health) : float
    {
        return $this->health = max(min($health, $this->getMaxHealth()), 0);
    }

    public function addHealth(float $health) : float
    {
        return $this->setHealth($this->getHealth() + $health);
    }

    public function removeHealth(float $health) : float
    {
        return $this->setHealth($this->getHealth() - $health);
    }
}