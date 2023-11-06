<?php

namespace App\Characters;

use App\Abilities\Ability;
use App\Enums\CharacterTypes;

interface Character
{
    /**
     * Тип персонажа
     *
     * @return CharacterTypes
     */
    public function getType() : CharacterTypes;

    /**
     * Максимальное здоровье
     *
     * @return float
     */
    public function getMaxHealth() : float;

    /**
     * Текущее здоровье
     *
     * @return float
     */
    public function getHealth() : float;

    /**
     * Установка текущего здоровья
     *
     * @param float $health
     *
     * @return float
     */
    public function setHealth(float $health) : float;

    /**
     * Добавление здоровья
     *
     * @param float $health
     *
     * @return float
     */
    public function addHealth(float $health) : float;

    /**
     * Уменьшение здоровья
     *
     * @param float $health
     *
     * @return float
     */
    public function removeHealth(float $health) : float;

    /**
     * Максимальный запас маны
     *
     * @return float
     */
    public function getMaxMana() : float;

    /**
     * Максимальный запас маны
     *
     * @return float
     */
    public function getMana() : float;

    /**
     * Способности
     *
     * @return array<Ability>
     */
    public function getAbilities() : array;
}