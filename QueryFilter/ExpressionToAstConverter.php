<?php

namespace Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter;

use Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\Exceptions\SyntaxErrorException;
use Pim\Component\Catalog\Query\Filter\Operators;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\SyntaxError;

class ExpressionToAstConverter
{
    /**
     * @var ExpressionLanguage
     */
    private $expressionLanguage;

    /**
     * @var AttributeOperatorMap
     */
    private $attributeOperatorMap;

    public function __construct(AttributeOperatorMap $attributeOperatorMap)
    {
        $this->attributeOperatorMap = $attributeOperatorMap;
    }

    public function convert(string $expression)
    {
        $this->initializeExpressionLanguage();

        try {
            $ast = $this->expressionLanguage
                ->parse($expression, $this->attributeOperatorMap->getAttributes())
                ->getNodes();

        } catch (SyntaxError $e) {
            throw new SyntaxErrorException($e->getMessage(), $e->getCode(), $e);
        }

        return $ast;
    }

    public function dump()
    {

//        $operators = $this->getAllOperators();
//        $functionNames = $this->getFunctionNames($operators);
//        var_dump($operators);
//        var_dump($functionNames);

//        var_dump($this->getAllOperators());

//        $filters = $this->getAttributeFilters();
//
//        foreach ($filters as $attribute => $filter) {
//            print $attribute . " ";
//            //var_dump($filter);
//        }

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

    private function initializeExpressionLanguage(): void
    {
        if (null !== $this->expressionLanguage) {
            return;
        }

        $this->expressionLanguage = new ExpressionLanguage();
        $dummyFunction = function() {};

        foreach ($this->getFunctionNames($this->attributeOperatorMap->getOperators()) as $functionName) {
            $this->expressionLanguage
                ->register($functionName, $dummyFunction, $dummyFunction);
        }
    }
}
