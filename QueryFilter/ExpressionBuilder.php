<?php

namespace Aa\Bundle\AkeneoQueryBundle\QueryFilter;

use Aa\Bundle\AkeneoQueryBundle\QueryFilter\Exceptions\SyntaxErrorException;
use Pim\Component\Catalog\Query\Filter\Operators;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\ParsedExpression;
use Symfony\Component\ExpressionLanguage\SyntaxError;

class ExpressionBuilder
{
    /**
     * @var ExpressionLanguage
     */
    private $expressionLanguage;

    public function __construct()
    {
        $this->expressionLanguage = new ExpressionLanguage();
    }

    public function build(string $expression, array $functions, array $attributes): ParsedExpression
    {
        $this->registerFunctions($functions);

        try {
            $expression = $this->expressionLanguage
                ->parse($expression, $attributes);

        } catch (SyntaxError $e) {
            throw new SyntaxErrorException($e->getMessage(), $e->getCode(), $e);
        }

        return $expression;
    }

    private function registerFunctions(array $functions)
    {
        $dummyFunction = function() {};

        foreach ($functions as $functionName) {
            $this->expressionLanguage
                ->register($functionName, $dummyFunction, $dummyFunction);
        }
    }
}