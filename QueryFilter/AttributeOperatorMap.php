<?php

namespace Aa\Bundle\AkeneoQueryBundle\QueryFilter;

use Pim\Component\Catalog\Query\Filter\FilterRegistryInterface;
use Pim\Component\Catalog\Repository\AttributeRepositoryInterface;

class AttributeOperatorMap
{
    /**
     * @var FilterRegistryInterface
     */
    private $filterRegistry;

    /**
     * @var AttributeRepositoryInterface
     */
    private $attributeRepository;

    public function __construct(FilterRegistryInterface $filterRegistry, AttributeRepositoryInterface $attributeRepository)
    {
        $this->filterRegistry = $filterRegistry;
        $this->attributeRepository = $attributeRepository;
    }

    public function getOperators(): array
    {
        $operators = [];
        foreach ($this->filterRegistry->getAttributeFilters() as $filter) {

            //$operators = $operators + $filter->getOperators();
            foreach ($filter->getOperators() as $operator) {
                $operators[$operator] = true;
            }
        }

        return array_keys($operators);
    }

    public function getAttributeFilters(): array
    {
        $attributeFilters = [];
        foreach ($this->filterRegistry->getAttributeFilters() as $filter) {
            $supportedAttributes = $filter->getAttributeTypes();

            if (null !== $supportedAttributes) {
                foreach ($supportedAttributes as $attribute) {
                    $attributeFilters[$attribute][] = $filter;
                }
            }
        }

        return $attributeFilters;
    }

    public function getAttributes(): array
    {
        $attributes = $this->attributeRepository->findAll();

        $attributeNames = [];
        foreach ($attributes as $attribute) {
            $attributeNames[] = $attribute->getCode();
        }

        return $attributeNames;
    }
}
