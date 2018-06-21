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
     * @var OperatorToFunction
     */
    private $operatorToFunction;

    /**
     * @var CollectionBuilder
     */
    private $collectionBuilder;

    public function __construct(
        OperatorToFunction $operatorToFunction,
        ExpressionBuilder $expressionBuilder,
        CollectionBuilder $collectionBuilder
    )
    {
        $this->expressionBuilder = $expressionBuilder;
        $this->operatorToFunction = $operatorToFunction;
        $this->collectionBuilder = $collectionBuilder;
    }

    public function convert(string $expressionText)
    {
        $this->collectionBuilder->build();

        $attributes = $this->collectionBuilder->getAttributes();

        $expression = $this->expressionBuilder->build($expressionText,
            $this->operatorToFunction->getExpressionFunctionNames(),
            $attributes->getExpressionAttributeNames());

        return $expression->getNodes();
    }
}
