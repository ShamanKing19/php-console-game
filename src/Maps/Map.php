<?php

namespace App\Maps;

use App\Characters\Character;
use App\Maps\Objects\MapObject;

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

    /**
     * Отображение меню для выбора противника
     *
     * @return Character
     */
    public function chooseEnemy() : Character;

    /**
     * Количество объектов на карте
     *
     * @return int
     */
    public function getObjectsCount() : int;

    /**
     * Объекты
     *
     * @return array
     */
    public function getObjects() : array;

    /**
     * Выбор объекта
     *
     * @return MapObject|null
     */
    public function chooseObject() : ?MapObject;

    /**
     * Удаление персонажа с карты
     *
     * @param Character $character
     *
     * @return bool
     */
    public function removeCharacter(Character $character) : bool;

    /**
     * Удаление объекта с карты
     *
     * @param MapObject $objectToRemove
     *
     * @return bool
     */
    public function removeObject(MapObject $objectToRemove) : bool;
}