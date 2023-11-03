<?php

namespace App;


use App\Enums\MenuActions;

class Kernel
{
    private Menu $menu;

    private array $actions = [

        MenuActions::CREATE_HERO->value => 'Создать героя',
        MenuActions::CREATE_MONSTER->value => 'Создать монстра',
        MenuActions::CREATE_MAP->value => 'Создать карту',
        MenuActions::ADD_OBJECT_TO_MAP->value => 'Добавить объект на карту',
        MenuActions::EDIT_OBJECT_ON_MAP->value => 'Изменить объект на карте',
        MenuActions::EXIT->value => 'Выйти',
    ];

    public function run() : void
    {
        $this->menu = $this->initMenu($this->actions);
        $this->menu->show();

        while(true) {
            $chosenActionKey = $this->menu->listen();
            match($chosenActionKey) {
                MenuActions::CREATE_HERO->value => $this->createHero(),
                MenuActions::CREATE_MONSTER->value => $this->createMonster(),
                MenuActions::CREATE_MAP->value => $this->createMap(),
                MenuActions::ADD_OBJECT_TO_MAP->value => $this->addObjectToMap(),
                MenuActions::EDIT_OBJECT_ON_MAP->value => $this->editObjectOnMap(),
                MenuActions::EXIT->value => $this->exit()
            };
        }
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

    private function exit() : void
    {
        echo 'Игра окончена.';
        die();
    }

    private function createHero() : void
    {

    }

    private function createMonster() : void
    {

    }

    private function createMap() : void
    {

    }

    private function addObjectToMap() : void
    {

    }

    private function editObjectOnMap() : void
    {

    }
}