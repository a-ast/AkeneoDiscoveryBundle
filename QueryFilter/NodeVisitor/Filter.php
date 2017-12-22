<?php

namespace Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\NodeVisitor;

class Filter
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $operator;
    /**
     * @var string
     */
    private $context;

    public function __construct(string $field, ?string $value, string $operator, string $context)
    {
        $this->field = $field;
        $this->value = $value;
        $this->operator = $operator;
        $this->context = $context;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function __toString(): string
    {
        return sprintf('%s %s %s', $this->field, $this->operator, $this->value);
    }
}