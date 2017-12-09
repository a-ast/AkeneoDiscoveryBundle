<?php

namespace Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter;

use Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\Exceptions\SyntaxErrorException;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\SyntaxError;

class ExpressionToAstConverter
{
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
}
