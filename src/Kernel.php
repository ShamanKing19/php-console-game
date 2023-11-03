<?php

namespace App;


class Kernel
{
    private Menu $menu;

    private array $actions = [
        1 => 'Создать героя',
        2 => 'Создать монстра',
        3 => 'Создать карту',
        4 => 'Добавить объект на карту',
        5 => 'Изменить объект на карте'
    ];

    public function run() : void
    {
        $this->menu = $this->initMenu($this->actions);
        $this->menu->show();

        $chosenActionKey = $this->menu->listen();

    }

    /**
     * Инициализация меню
     *
     * @param array $actions
     *
     * @return Menu
     */
    private function initMenu(array $actions) : Menu
    {
        return new Menu($actions);
    }

    private function initMap() : void
    {

    }

    private function initHeroes() : void
    {

    }

    private function initEnemies() : void
    {

    }
}