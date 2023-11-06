<?php

namespace App\Abilities;

use App\Characters\Character;

interface Ability
{
    /**
     * Использование способности
     *
     * @return bool Была ли применена способность
     */
    public function use(Character $character) : bool;

    /**
     * Название
     *
     * @return string
     */
    public function getName() : string;

    /**
     * Наносимый урон
     *
     * @return float
     */
    public function getDamage() : float;

    /**
     * Затраты маны
     *
     * @return float
     */
    public function getManaCost() : float;

    /**
     * Количество использований способности
     *
     * @return int
     */
    public function getTimesUsed() : int;

    /**
     * Максимальное количество использований способности
     *
     * @return int
     */
    public function getMaxUseCount() : int;

    /**
     * Оставшееся количество использований
     *
     * @return int
     */
    public function getUsesLeft() : int;

    /**
     * Есть ли ограничение на использование способности
     *
     * @return bool
     */
    public function isLimitedUsage() : bool;
}