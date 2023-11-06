<?php

namespace App\Maps\Objects;

use App\Characters\Character;
use App\Enums\MapObjectEffect;
use App\Enums\MapObjectEffectType;

interface MapObject
{
    /**
     * Идентификатор объекта
     *
     * @return int
     */
    public function getId() : int;

    /**
     * Название объекта
     *
     * @return string
     */
    public function getName() : string;

    /**
     * Эффект (урон, лечение, ...)
     *
     * @return MapObjectEffect
     */
    public function getEffect() : MapObjectEffect;

    /**
     * Тип эффекта (одиночный, глобальный, ...)
     *
     * @return MapObjectEffectType
     */
    public function getType() : MapObjectEffectType;

    /**
     * Значение (урона, лечения, ...)
     *
     * @return float
     */
    public function getValue() : float;

    /**
     * Установка цели
     *
     * @param array<Character> $characters
     *
     * @return void
     */
    public function setTargets(array &$characters) : void;

    /**
     * Цели
     *
     * @return array<Character>
     */
    public function getTargets() : array;

    /**
     * Запуск действий объекта
     *
     * @return void
     */
    public function trigger() : void;
}
