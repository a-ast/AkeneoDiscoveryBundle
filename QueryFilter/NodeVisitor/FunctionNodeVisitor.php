<?php

namespace Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\NodeVisitor;

use Symfony\Component\ExpressionLanguage\Node\FunctionNode;
use Symfony\Component\ExpressionLanguage\Node\Node;

class FunctionNodeVisitor implements FilterNodeVisitorInterface
{
    /**
     * @var FunctionNode
     */
    private $node;

    public function __construct(FunctionNode $node)
    {
        $this->node = $node;
    }

    public function getFieldNode(): Node
    {
        return $this->node->nodes['arguments']->nodes[0];
    }

    public function getValueNode(): ?Node
    {
        if (isset($this->node->nodes['arguments']->nodes[1])) {
            return $this->node->nodes['arguments']->nodes[1];
        }

        return null;
    }

    public function getOperator(): string
    {
        return $this->node->attributes['name'];
    }

    public function validate()
    {
        // TODO: Implement validate() method.
    }
}
