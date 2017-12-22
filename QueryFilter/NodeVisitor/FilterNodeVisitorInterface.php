<?php
namespace Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\NodeVisitor;

use Symfony\Component\ExpressionLanguage\Node\Node;

interface FilterNodeVisitorInterface extends NodeVisitorInterface
{
    public function getFieldNode(): Node;

    public function getValueNode(): ?Node;

    public function getOperator(): string;
}