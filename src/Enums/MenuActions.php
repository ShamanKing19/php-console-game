<?php

namespace App\Enums;

enum MenuActions : int
{
    case EXIT = 0;
    case CREATE_HERO = 1;
    case CREATE_MONSTER = 2;
    case CREATE_MAP = 3;
    case ADD_OBJECT_TO_MAP = 4;
    case EDIT_OBJECT_ON_MAP = 5;
}