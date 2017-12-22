<?php

namespace Aa\Bundle\AkeneoQueryBundle\QueryFilter\NodeVisitor;

use Symfony\Component\ExpressionLanguage\Node\BinaryNode;
use Symfony\Component\ExpressionLanguage\Node\ConstantNode;
use Symfony\Component\ExpressionLanguage\Node\FunctionNode;
use Symfony\Component\ExpressionLanguage\Node\NameNode;
use Symfony\Component\ExpressionLanguage\Node\Node;

class NodeVisitorFactory
{
    public function createVisitor(Node $node)
    {
        if ($node instanceof BinaryNode) {
            return new BinaryNodeVisitor($node);
        }

        if ($node instanceof FunctionNode) {
            return new FunctionNodeVisitor($node);
        }

        if ($node instanceof NameNode) {
            return new NameNodeVisitor($node);
        }

        if ($node instanceof ConstantNode) {
            return new ConstantNodeVisitor($node);
        }
    }
}
