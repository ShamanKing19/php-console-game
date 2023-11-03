<?php

namespace App;

class Menu
{

    private array $actions;

    /**
     * @param array<int,string> $actions Действия
     */
    public function __construct(array $actions)
    {
        $this->actions = $actions;
    }

    /**
     * Отображение меню
     *
     * @return void
     */
    public function show() : void
    {
        foreach($this->actions as $key => $action) {
            echo $key . '. ' . $action . PHP_EOL;
        }

        echo PHP_EOL;
    }

    /**
     * Слушатель выбора действия пользователя
     *
     * @return int
     */
    public function listen() : int
    {
        $action = readline('Верите действие' . PHP_EOL);
        if(isset($this->actions[$action])) {
            return $action;
        }

        echo 'Такого действия нет' . PHP_EOL . PHP_EOL;
        return $this->listen();
    }
}