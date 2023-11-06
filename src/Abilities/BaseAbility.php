<?php

namespace App\Abilities;

use App\Characters\Character;

class BaseAbility implements Ability
{
    protected string $name;
    protected float $damage;
    protected float $manaCost;
    protected int $maxUseCount;
    protected int $timesUsed;

    public function __construct(float $damage, float $manaCost, int $maxUseCount = 0)
    {
        $this->damage = $damage;
        $this->manaCost = $manaCost;
        $this->maxUseCount = $maxUseCount;
        $this->timesUsed = 0;
    }

    public function use(Character $character): bool
    {
        if($this->getMaxUseCount() > 0 && $this->getTimesUsed() >= $this->getMaxUseCount()) {
            return false;
        }

        $character->removeHealth($this->getDamage());
        $this->timesUsed++;
        return true;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDamage(): float
    {
        return $this->damage;
    }

    public function getManaCost(): float
    {
        return $this->manaCost;
    }

    public function getTimesUsed(): int
    {
        return $this->timesUsed;
    }

    public function getMaxUseCount(): int
    {
        return $this->maxUseCount;
    }
}