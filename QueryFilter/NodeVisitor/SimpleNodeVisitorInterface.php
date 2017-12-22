<?php
namespace Aa\Bundle\AkeneoQueryBundle\QueryFilter\NodeVisitor;

interface SimpleNodeVisitorInterface extends NodeVisitorInterface
{
    public function getValue(): string;
}