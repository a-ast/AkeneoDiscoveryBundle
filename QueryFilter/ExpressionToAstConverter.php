<?php

namespace Aa\Bundle\AkeneoQueryBundle\QueryFilter;

use Aa\Bundle\AkeneoQueryBundle\Attribute\CollectionBuilder;

class ExpressionToAstConverter
{
    /**
     * @var ExpressionBuilder
     */
    private $expressionBuilder;

    /**
     * @var CollectionBuilder
     */
    private $collectionBuilder;

    public function __construct(
        ExpressionBuilder $expressionBuilder,
        CollectionBuilder $collectionBuilder
    )
    {
        $this->expressionBuilder = $expressionBuilder;
        $this->collectionBuilder = $collectionBuilder;
    }

    public function convert(string $expressionText)
    {
        $this->collectionBuilder->build();

        $attributes = $this->collectionBuilder->getAttributes();
        $operators = $this->collectionBuilder->getOperators();

        $expression = $this->expressionBuilder->build($expressionText,
            $operators->getExpressionFunctions(),
            $attributes->getExpressionAttributeNames());

        return $expression->getNodes();
    }
}
