<?php

namespace Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter;

use Symfony\Component\ExpressionLanguage\Node\BinaryNode;
use Symfony\Component\ExpressionLanguage\Node\Node;

class AstToFiltersConverter
{
    public function convert(Node $node)
    {
        // @todo: return filters in this format
        // $pqb->addFilter($filter['field'], $filter['operator'], $filter['value'], $filter['context']);

        $filters = [];

        $this->convertRecursive($node, '', $filters);

        return $filters;
    }

    private function convertRecursive(Node $node, $shift = '', array &$filters)
    {
        $filters[] = $shift . get_class($node);

//      @todo:  if ($node instanceof BinaryNode)

        foreach ($node->nodes as $child) {

            $this->convertRecursive($child, $shift . '  ', $filters);
        }
    }
}
