<?php

namespace Aa\Bundle\AkeneoQueryBundle\QueryFilter\NodeVisitor;

use Symfony\Component\ExpressionLanguage\Node\ConstantNode;

class ConstantNodeVisitor implements SimpleNodeVisitorInterface
{
    /**
     * @var ConstantNode
     */
    private $node;

    public function __construct(ConstantNode $node)
    {
        $this->node = $node;
    }

    public function getValue()
    {
        return $this->node->attributes['value'];
    }
}
