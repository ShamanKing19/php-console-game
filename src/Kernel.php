<?php

namespace App;


use App\Characters\Character;
use App\Characters\Heroes\AncientRus;
use App\Characters\Heroes\Batman;
use App\Characters\Heroes\Spiderman;
use App\Characters\CharacterFactory;
use App\Enums\MenuActions;
use App\Maps\Map;
use App\Maps\MapFactory;
use App\Maps\TrainingMap;

class Kernel
{
    private Menu $menu;

    private array $actions = [
        MenuActions::PLAY->value => 'Играть',
        MenuActions::CHOOSE_MAP->value => 'Выбрать карту',
        MenuActions::CHOOSE_HERO->value => 'Выбрать героя',
        MenuActions::EXIT->value => 'Выйти',
    ];

    private Character $hero;

    private Map $map;


    public function run() : void
    {
        $menu = new Menu($this->actions);

        while(true) {
            $menu->show();
            $chosenActionKey = $menu->listen();
            $result = match($chosenActionKey) {
                MenuActions::PLAY->value => $this->play(),
                MenuActions::CHOOSE_HERO->value => $this->chooseHero(),
                MenuActions::CHOOSE_MAP->value => $this->chooseMap(),
                MenuActions::EXIT->value => $this->exit(),
                default => 'Такого действия нет'
            };

            echo PHP_EOL . $result . PHP_EOL . PHP_EOL;
        }
    }

    /**
     * Выход из игры
     *
     * @return void
     */
    private function exit() : void
    {
        echo 'Игра окончена.';
        die();
    }

    private function play() : string
    {
        if(!isset($this->map)) {
            return 'Чтобы начать играть, нужно выбрать карту';
        }

        if(!isset($this->hero)) {
            return 'Чтобы начать играть, нужно выбрать персонажа';
        }

        return 'Игра началась...';
    }

    private function chooseHero() : string
    {
        $heroes = [
            1 => AncientRus::$name,
            2 => Batman::$name,
            3 => Spiderman::$name
        ];

        $menu = new Menu($heroes);
        $menu->show();
        $chosenHero = $menu->listen();

        $heroFactory = new CharacterFactory();

        $hero = match($chosenHero) {
            1 => $heroFactory->createAncientRus(),
            2 => $heroFactory->createBatman(),
            3 => $heroFactory->createSpiderMan(),
            default => null
        };

        if($hero === null) {
            return 'Герой не найден';
        }

        $this->hero = $hero;

        return 'Выбран герой: ' . $hero->getName();
    }

    private function chooseMap() : string
    {
        $maps = [
            1 => TrainingMap::$name,
        ];

        $menu = new Menu($maps);
        $menu->show();
        $chosenHero = $menu->listen();

        $factory = new MapFactory();

        $map = match($chosenHero) {
            1 => $factory->createTrainingMap(),
            default => null
        };

        if($map === null) {
            return 'Карта не найдена';
        }

        $this->map = $map;

        return 'Выбрана карта: ' . $map->getName();
    }
}