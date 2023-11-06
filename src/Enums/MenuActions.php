<?php

namespace App\Enums;

enum MenuActions : int
{
    case EXIT = 0;
    case PLAY = 1;
    case CHOOSE_MAP = 2;
    case CHOOSE_HERO = 3;
}