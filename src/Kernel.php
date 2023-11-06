<?php

namespace App;


use App\Characters\Character;
use App\Characters\Heroes\AncientRus;
use App\Characters\Heroes\Batman;
use App\Characters\Heroes\Spiderman;
use App\Characters\CharacterFactory;
use App\Enums\MapObjectEffectType;
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

            consoleLog(PHP_EOL . $result . PHP_EOL);
        }
    }

    /**
     * Выход из игры
     *
     * @return void
     */
    private function exit() : void
    {
        consoleLog('Игра окончена.');
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

        consoleLog('Выбранная карта: ' . $this->map->getName());
        consoleLog('Количество противников: ' . $this->map->getEnemiesCount());

        while($this->hero->getHealth() > 0 && $this->map->getEnemiesCount() > 0) {
            consoleLog('Ваше здоровье: ' . $this->hero->getHealth());
            consoleLog('Ваша мана: ' . $this->hero->getMana());
            consoleLog();

            // Выбор объектов на карте
            $object = null;
            if($this->map->getObjectsCount() > 0) {
                $object = $this->map->chooseObject();
            }

            if($object) {
                $targets = $this->map->getEnemies();
                $targets[] = $this->hero;
                if($object->getType() === MapObjectEffectType::ALL) {
                    $object->setTargets($targets);
                    $object->trigger();
                } elseif($object->getType() === MapObjectEffectType::SINGLE) {
                    $target = $this->map->chooseEnemy($this->hero);
                    $targets = [$target];
                    $object->setTargets($targets);
                    $object->trigger();
                }

                $this->map->removeObject($object);
            } else {
                $enemy = $this->map->chooseEnemy();
                consoleLog('Выбран противник: ' . $enemy->getName());

                $ability = $this->hero->chooseAbility();
                consoleLog('Применяем "' . $ability->getName() . '" на противника "' . $enemy->getName() . '"');

                $success = $ability->use($enemy);
                if(!$success) {
                    consoleLog('Способность "' . $ability->getName() .  '" не была применена');
                    continue;
                }

                if($enemy->isDead()) {
                    consoleLog('"' . $enemy->getName() . '" убит');
                    $this->map->removeCharacter($enemy);
                    if(empty($this->map->getEnemies())) {
                        return 'Все противники побеждены. Вы победили!';
                    }
                }
            }

            $enemies = $this->map->getEnemies();
            $randomEnemyKey = array_rand($enemies);
            $randomEnemy = $enemies[$randomEnemyKey];

            $enemyAbilities = $randomEnemy->getAbilities();
            $randomEnemyAbilityKey = array_rand($enemyAbilities);
            $randomEnemyAbility = $enemyAbilities[$randomEnemyAbilityKey];
            $success = $randomEnemyAbility->use($this->hero);
            if(!$success) {
                consoleLog('Способность "' . $randomEnemyAbility->getName() .  '" не была применена');
                continue;
            }

            consoleLog('Противник "' . $randomEnemy->getName() . '" использовал "' . $randomEnemyAbility->getName() . '" и нанёс ' . $randomEnemyAbility->getDamage() . ' урона');
            if($this->hero->isDead()) {
                consoleLog('Вы погибли и проиграли сражение...');
            }
        }

        return 'Игра окончена.';
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