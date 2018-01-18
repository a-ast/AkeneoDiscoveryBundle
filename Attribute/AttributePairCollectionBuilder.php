<?php

namespace Aa\Bundle\AkeneoQueryBundle\Attribute;

use Pim\Component\Catalog\Model\AttributeInterface;
use Pim\Component\Catalog\Query\Filter\FilterRegistryInterface;
use Pim\Component\Catalog\Repository\AttributeRepositoryInterface;

class AttributePairCollectionBuilder
{
    /**
     * @var FilterRegistryInterface
     */
    private $filterRegistry;

    /**
     * @var AttributeRepositoryInterface
     */
    private $attributeRepository;

    /**
     * @var PimAttributeFactory
     */
    private $pimAttributeFactory;

    public function __construct(
        FilterRegistryInterface $filterRegistry,
        AttributeRepositoryInterface $attributeRepository,
        PimAttributeFactory $pimAttributeFactory
    ) {
        $this->filterRegistry = $filterRegistry;
        $this->attributeRepository = $attributeRepository;
        $this->pimAttributeFactory = $pimAttributeFactory;
    }

    public function build(AttributePairCollection $collection)
    {
        $attributeTypeFilters = $this->getAttributeTypeFilters();
        $attributes = $this->attributeRepository->findAll();

        $rows = [];
        foreach ($attributes as $attribute) {
            $pimAttributes = $this->getPimAttributes($attribute, $attributeTypeFilters);

            foreach ($pimAttributes as $pimAttribute) {
                $collection->add($pimAttribute,
                    new ExpressionAttribute('', [])
                    );
            }
        }

        return $rows;
    }

    /**
     * @return PimAttribute[]
     */
    protected function getPimAttributes(AttributeInterface $attribute, array $attributeTypeFilters): array
    {
        $pimAttributes = [];

        if (array_key_exists($attribute->getType(), $attributeTypeFilters)) {
            foreach ($attributeTypeFilters[$attribute->getType()] as $filter) {
                $pimAttributes[] = $this->pimAttributeFactory->create($attribute, $filter);
            }

            return $pimAttributes;
        }

        if ($attribute->isBackendTypeReferenceData()) {
            foreach ($this->filterRegistry->getAttributeFilters() as $filter) {
                if (!$filter->supportsAttribute($attribute)) {
                    continue;
                }

                $pimAttributes[] = $this->pimAttributeFactory->create($attribute, $filter);
            }

            return $pimAttributes;
        }
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
}
