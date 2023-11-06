<?php

namespace App\Characters;

use App\Abilities\Ability;
use App\Enums\CharacterTypes;
use App\Menu;

class BaseCharacter implements Character
{
    /** @var string Название персонажа */
    public static string $name;

    private int $id;
    private CharacterTypes $type;

    private float $maxHealth;
    private float $health;

    private float $maxMana;
    private float $mana;

    private array $abilities;


    public function __construct(CharacterTypes $type, int $maxHealth, int $maxMana, array $abilities = [])
    {
        $this->id = random_int(1, 999999999);

        $this->type = $type;

        $this->maxHealth = $maxHealth;
        $this->health = $maxHealth;

        $this->maxMana = $maxMana;
        $this->mana = $maxMana;

        $this->abilities = $abilities;
    }

    public function getId(): int
    {
        return $this->id;
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

    /**
     * Отображение списка способностей для выбора одной из них
     *
     * @return Ability
     */
    public function chooseAbility() : Ability
    {
        $abilityList = $this->getAbilities();
        $actions = [];
        foreach($abilityList as $key => $ability) {
            $actions[$key + 1] = $ability->getName() . ' (' . $ability->getDamage() . 'dmg, ' . $ability->getManaCost() . ' mana)';
        }

        $menu = new Menu($actions, 'Выберите способность: ');

        while(true) {
            $menu->show();
            $target = $menu->listen();
            if(isset($abilityList[$target - 1])) {
                return $abilityList[$target - 1];
            }

            echo 'Нет такой способности' . PHP_EOL;
        }
    }

    public function isAlive(): bool
    {
        return $this->getHealth() > 0.0;
    }

    public function isDead(): bool
    {
        return !$this->isAlive();
    }
}