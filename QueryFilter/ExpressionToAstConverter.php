<?php

namespace Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter;

use Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\Exceptions\SyntaxErrorException;
use Pim\Component\Catalog\Query\Filter\FilterRegistryInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\SyntaxError;

class ExpressionToAstConverter
{
    /**
     * @var FilterRegistryInterface
     */
    private $filterRegistry;

    public function __construct(FilterRegistryInterface $filterRegistry)
    {
        $this->filterRegistry = $filterRegistry;
    }

    public function convert(string $expression)
    {
        $expressionLanguage = new ExpressionLanguage();

        $expressionLanguage
            ->register('contains', function() { }, function() { });

        try {
            $ast = $expressionLanguage
                ->parse($expression, ['sku'])
                ->getNodes();

        } catch (SyntaxError $e) {
            throw new SyntaxErrorException($e->getMessage(), $e->getCode(), $e);
        }

        return $ast;
    }

    public function dump()
    {
        var_dump($this->getAllOperators());

//        $filters = $this->getAttributeFilters();
//
//        foreach ($filters as $attribute => $filter) {
//            print $attribute . " ";
//            //var_dump($filter);
//        }

    }

    protected function getAttributeFilters(): array
    {
        $attributeFilters = [];
        foreach ($this->filterRegistry->getAttributeFilters() as $filter) {
            $supportedAttributes = $filter->getAttributeTypes();

            if (null !== $supportedAttributes) {
                foreach ($supportedAttributes as $attribute) {
                    $attributeFilters[$attribute][] = $filter;
                }
            }
        }

        return $attributeFilters;
    }

    protected function getAllOperators(): array
    {
        $operators = [];
        foreach ($this->filterRegistry->getAttributeFilters() as $filter) {

            $operators = $operators + $filter->getOperators();
            foreach ($filter->getOperators() as $operator) {
                $operators[$operator] = true;
            }
        }

        return array_keys($operators);
    }

}
