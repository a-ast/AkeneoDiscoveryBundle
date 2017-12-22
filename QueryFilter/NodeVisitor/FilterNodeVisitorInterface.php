<?php
namespace Aa\Bundle\AkeneoQueryBundle\QueryFilter\NodeVisitor;

use Symfony\Component\ExpressionLanguage\Node\Node;

interface FilterNodeVisitorInterface extends NodeVisitorInterface
{
    public function getFieldNode(): Node;

    public function getValueNode(): ?Node;

    public function getOperator(): string;
}