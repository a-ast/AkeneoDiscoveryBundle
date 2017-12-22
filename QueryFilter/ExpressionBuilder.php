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

    public function build(string $expression, array $operators, array $attributes): ParsedExpression
    {
        $this->registerFunctions($operators);

        try {
            $expression = $this->expressionLanguage
                ->parse($expression, $attributes);

        } catch (SyntaxError $e) {
            throw new SyntaxErrorException($e->getMessage(), $e->getCode(), $e);
        }

        return $expression;
    }

    private function registerFunctions(array $operators)
    {
        $dummyFunction = function() {};

        foreach ($this->getFunctionNames($operators) as $functionName) {
            $this->expressionLanguage
                ->register($functionName, $dummyFunction, $dummyFunction);
        }
    }

    private function getFunctionNames(array $operators)
    {
        $supportedOperarors = [
            Operators::EQUALS,
            Operators::NOT_EQUAL,
            Operators::LOWER_THAN,
            Operators::LOWER_OR_EQUAL_THAN,
            Operators::GREATER_THAN,
            Operators::GREATER_OR_EQUAL_THAN,
            Operators::IN_LIST,
            Operators::NOT_IN_LIST,

        ];

        $functionNames = [];

        foreach ($operators as $operatorName) {
            if (in_array($operatorName, $supportedOperarors)) {
                continue;
            }

            $functionNames[] = str_replace(' ', '_', strtolower($operatorName));
        }

        return $functionNames;
    }
}