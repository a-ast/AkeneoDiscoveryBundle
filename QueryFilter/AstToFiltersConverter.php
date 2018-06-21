<?php

namespace Aa\Bundle\AkeneoQueryBundle\QueryFilter;

use Aa\Bundle\AkeneoQueryBundle\Filter\FilterFactory;
use Aa\Bundle\AkeneoQueryBundle\QueryFilter\NodeVisitor\FilterNodeVisitorInterface;
use Aa\Bundle\AkeneoQueryBundle\QueryFilter\NodeVisitor\NodeVisitorFactory;
use Aa\Bundle\AkeneoQueryBundle\QueryFilter\NodeVisitor\SimpleNodeVisitorInterface;
use ArrayObject;
use Symfony\Component\ExpressionLanguage\Node\Node;

class AstToFiltersConverter
{
    /**
     * @var NodeVisitorFactory
     */
    private $factory;
    /**
     * @var FilterFactory
     */
    private $filterFactory;

    public function __construct(NodeVisitorFactory $nodeVisitorFactory, FilterFactory $filterFactory)
    {
        $this->factory = $nodeVisitorFactory;
        $this->filterFactory = $filterFactory;
    }

    public function convert(Node $node)
    {
        $filters = new ArrayObject();

        $this->iterateNodes($node, $filters);

        return $filters;
    }

    private function iterateNodes(?Node $node, ArrayObject $filters)
    {
        if (null === $node) {
            return null;
        }

        $visitor = $this->getVisitorByNode($node);

        if ($visitor instanceof SimpleNodeVisitorInterface) {
            return $visitor->getValue();
        }

        if ($visitor instanceof FilterNodeVisitorInterface) {

            $field = $this->iterateNodes($visitor->getFieldNode(), $filters);
            $value = $this->iterateNodes($visitor->getValueNode(), $filters);

            if (null === $field) {
                return null;
            }

            // @todo: parse field and add context?

            $filters[] = $this->filterFactory->create($field, $value, $visitor->getOperator(), '');
        }
    }

    private function getVisitorByNode(Node $node)
    {
        return $this->factory->createVisitor($node);
    }
}
