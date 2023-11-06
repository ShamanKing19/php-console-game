<?php

namespace App\Maps;

use App\Characters\Character;
use App\Maps\Objects\MapObject;
use App\Menu;

class BaseMap implements Map
{
    public static string $name;

    private array $enemies;
    private array $objects;

    /**
     * @param array<Character> $enemies
     * @param array<MapObject> $objects
     */
    public function __construct(array $enemies, array $objects = [])
    {
        $this->enemies = $enemies;
        $this->objects = $objects;
    }

    public function getName(): string
    {
        return static::$name;
    }

    public function getEnemiesCount(): int
    {
        return count($this->enemies);
    }

    public function getEnemies(): array
    {
        return $this->enemies;
    }


    public function chooseObject() : ?MapObject
    {
        $objects = $this->getObjects();
        $actions = [];
        foreach($objects as $key => $object) {
            $actions[$key + 1] = $object->getName() . ' (' . $object->getValue() . 'HP)';
        }

        $actions[0] = 'Ничего не использовать';

        $menu = new Menu($actions, 'Выберите объект: ');

        while(true) {
            $menu->show();
            $target = $menu->listen();
            if($target === 0) {
                return null;
            }

            if(isset($objects[$target - 1])) {
                return $objects[$target - 1];
            }

            consoleLog('Нет такого объекта');
        }
    }

    public function chooseEnemy(Character $character = null) : Character
    {
        $enemies = $this->getEnemies();
        $actions = [];
        if($character !== null) {
            $actions[] = $character->getName();
        }

        foreach($enemies as $key => $enemy) {
            $actions[$key + 1] = $enemy->getName() . ' (' . $enemy->getHealth() . 'HP)';
        }

        $menu = new Menu($actions, 'Выберите цель: ');

        while(true) {
            $menu->show();
            $target = $menu->listen();
            if($target === 0) {
                return $character;
            }

            if(isset($enemies[$target - 1])) {
                return $enemies[$target - 1];
            }

            consoleLog('Нет такой цели');
        }
    }

    public function removeCharacter(Character $character): bool
    {
        foreach($this->enemies as $key => $enemy) {
            if($enemy->getId() === $character->getId()) {
                unset($this->enemies[$key]);
                return true;
            }
        }

        return false;
    }

    public function removeObject(MapObject $objectToRemove): bool
    {
        foreach($this->objects as $key => $object) {
            if($object->getId() === $objectToRemove->getId()) {
                unset($this->objects[$key]);
                return true;
            }
        }

        return false;
    }

    public function getObjects(): array
    {
        return $this->objects;
    }

    public function getObjectsCount(): int
    {
        return count($this->getObjects());
    }
}