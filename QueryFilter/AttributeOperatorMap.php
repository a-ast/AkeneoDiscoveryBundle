<?php

namespace Aa\Bundle\AkeneoQueryBundle\QueryFilter;

use Aa\Bundle\AkeneoQueryBundle\Attribute\PimAttribute;
use Pim\Component\Catalog\Model\AttributeInterface;
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

    private function getAttributeTypeFilters(): array
    {
        $attributeFilters = [];

        foreach ($this->filterRegistry->getAttributeFilters() as $filter) {
            $supportedAttributes = $filter->getAttributeTypes();

            if (null === $supportedAttributes) {
                continue;
            }

            foreach ($supportedAttributes as $attribute) {
                $attributeFilters[$attribute][] = $filter;
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


    protected function getFilterInformationForAttribute(AttributeInterface $attribute, array $attributeTypeFilters)
    {

        $newEntries = [];
        if (array_key_exists($attribute->getType(), $attributeTypeFilters)) {
            foreach ($attributeTypeFilters[$attribute->getType()] as $filter) {

                $newEntries[] = new PimAttribute(
                    $attribute->getCode(),
                    $attribute->isLocalizable(),
                    $attribute->isScopable(),
                    $attribute->getType(),
                    $filter->getOperators()
                );
            }

            return $newEntries;
        }

        if ($attribute->isBackendTypeReferenceData()) {
            foreach ($this->filterRegistry->getAttributeFilters() as $filter) {
                if ($filter->supportsAttribute($attribute)) {

                    $newEntries[] = new PimAttribute(
                        $attribute->getCode(),
                        $attribute->isLocalizable(),
                        $attribute->isScopable(),
                        $attribute->getType(),
                        $filter->getOperators()
                    );
                }
            }

            return $newEntries;
        }
    }

    public function getMap()
    {
        $attributeTypeFilters = $this->getAttributeTypeFilters();
        $attributes = $this->attributeRepository->findAll();

        $rows = [];
        foreach ($attributes as $attribute) {
            $rows = array_merge($rows, $this->getFilterInformationForAttribute($attribute, $attributeTypeFilters));
        }

        return $rows;
    }
}
