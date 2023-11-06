<?php

namespace App\Maps;

use App\Characters\Character;

interface Map
{
    /**
     * Название карты
     *
     * @return string
     */
    public function getName() : string;

    /**
     * Количество противников
     *
     * @return int
     */
    public function getEnemiesCount() : int;

    /**
     * Противники
     *
     * @return array<Character>
     */
    public function getEnemies() : array;
}