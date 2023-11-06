<?php

namespace App;

class Menu
{

    private array $actions;
    private string $prompt;

    /**
     * @param array<int,string> $actions Действия
     */
    public function __construct(array $actions, string $prompt = 'Выберите действие: ')
    {
        $this->actions = $actions;
        $this->prompt = $prompt;
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
        $action = readline($this->prompt);
        if(isset($this->actions[$action])) {
            return $action;
        }

        return -1;
    }
}