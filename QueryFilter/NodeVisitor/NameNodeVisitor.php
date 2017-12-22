<?php

namespace Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\NodeVisitor;

use Symfony\Component\ExpressionLanguage\Node\NameNode;

class NameNodeVisitor implements SimpleNodeVisitorInterface
{
    /**
     * @var NameNode
     */
    private $node;

    public function __construct(NameNode $node)
    {
        $this->node = $node;
    }

    public function getValue(): string
    {
        return $this->node->attributes['name'];
    }

    public function validate()
    {
        // TODO: Implement validate() method.
    }
}
