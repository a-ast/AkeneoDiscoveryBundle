<?php
namespace Aa\Bundle\AkeneoDiscoveryBundle\QueryFilter\NodeVisitor;

interface SimpleNodeVisitorInterface extends NodeVisitorInterface
{
    public function getValue(): string;
}