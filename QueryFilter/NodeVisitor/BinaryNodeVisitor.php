<?php

namespace Aa\Bundle\AkeneoQueryBundle\QueryFilter\NodeVisitor;

use Symfony\Component\ExpressionLanguage\Node\BinaryNode;
use Symfony\Component\ExpressionLanguage\Node\Node;

class BinaryNodeVisitor implements FilterNodeVisitorInterface
{
    /**
     * @var BinaryNode
     */
    private $node;

    public function __construct(BinaryNode $node)
    {
        $this->node = $node;
    }

    public function getFieldNode(): Node
    {
        return $this->node->nodes['left'];
    }

    public function getValueNode(): ?Node
    {
        return $this->node->nodes['right'];
    }

    public function getOperator(): string
    {
        return $this->node->attributes['operator'];
    }
}
