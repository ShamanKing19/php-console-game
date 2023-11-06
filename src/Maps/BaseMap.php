<?php

namespace App\Maps;

use App\Characters\Character;
use App\Menu;

class BaseMap implements Map
{
    public static string $name;

    private array $enemies;

    /**
     * @param array<Character> $enemies
     */
    public function __construct(array $enemies)
    {
        $this->enemies = $enemies;
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

    /**
     * Отображение меню для выбора противника
     *
     * @return Character
     */
    public function chooseEnemy() : Character
    {
        $enemies = $this->getEnemies();
        $actions = [];
        foreach($enemies as $key => $enemy) {
            $actions[$key + 1] = $enemy->getName() . ' (' . $enemy->getHealth() . 'HP)';
        }

        $menu = new Menu($actions, 'Выберите цель: ');

        while(true) {
            $menu->show();
            $target = $menu->listen();
            if(isset($enemies[$target - 1])) {
                return $enemies[$target - 1];
            }

            consoleLog('Нет такого противника');
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
}