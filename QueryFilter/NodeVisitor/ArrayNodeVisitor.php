<?php
declare(strict_types=1);

namespace Aa\Bundle\AkeneoQueryBundle\QueryFilter\NodeVisitor;

use Symfony\Component\ExpressionLanguage\Node\ArrayNode;

class ArrayNodeVisitor implements SimpleNodeVisitorInterface
{
    /**
     * @var ArrayNode
     */
    private $node;

    public function __construct(ArrayNode $node)
    {
        $this->node = $node;
    }

    public function getValue()
    {
        $array = [];

        foreach ($this->node->nodes as $key => $node) {
            if ($key % 2 === 0 ) {
                continue;
            }

            $array[] = $node->attributes['value'];
        }
        
        return $array;
    }
}
