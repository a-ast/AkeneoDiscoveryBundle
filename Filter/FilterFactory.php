<?php

namespace Aa\Bundle\AkeneoQueryBundle\Filter;

use Aa\Bundle\AkeneoQueryBundle\Attribute\CollectionBuilder;

class FilterFactory
{
    /**
     * @var CollectionBuilder
     */
    private $collectionBuilder;

    public function __construct(CollectionBuilder $collectionBuilder)
    {
        $this->collectionBuilder = $collectionBuilder;
    }

    public function create(string $field, string $value, string $operator, string $context)
    {
        $operators = $this->collectionBuilder->getOperators();

        $pimOperator = $operators->getOperatorByExpressionOperator($operator);

        return new Filter($field, $value, $pimOperator, $context);
    }
}
