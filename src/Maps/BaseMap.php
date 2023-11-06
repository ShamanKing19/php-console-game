<?php

namespace App\Maps;

class BaseMap implements Map
{
    public static string $name;

    private array $enemies;

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
}