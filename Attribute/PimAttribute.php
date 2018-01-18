<?php

namespace Aa\Bundle\AkeneoQueryBundle\Attribute;

class PimAttribute
{
    private $name;

    private $type;

    private $isLocalizable;

    private $isScopable;

    private $operators;

    public function __construct(string $name, string $type, bool $isLocalizable, bool $isScopable, array $operators)
    {
        $this->name = $name;
        $this->type = $type;
        $this->isLocalizable = $isLocalizable;
        $this->isScopable = $isScopable;
        $this->operators = $operators;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isLocalizable(): bool
    {
        return $this->isLocalizable;
    }

    public function isScopable(): bool
    {
        return $this->isScopable;
    }

    public function getOperators(): array
    {
        return $this->operators;
    }

    public function getExpressionAttributes()
    {
        $attributes[] = $this->getName();

        if ($this->isLocalizable()) {
            $attributes[] = $this->getName() . 'locale';
        }
    }
}