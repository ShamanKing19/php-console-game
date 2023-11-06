<?php

/**
 * Вывод сообщения в консоль
 *
 * @param string $message
 *
 * @return void
 */
function consoleLog(string $message = '') : void
{
    echo $message . PHP_EOL;
}
