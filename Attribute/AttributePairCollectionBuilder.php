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

    /**
     * @var ExpressionAttributeFactory
     */
    private $expressionAttributeFactory;

    public function __construct(
        FilterRegistryInterface $filterRegistry,
        AttributeRepositoryInterface $attributeRepository,
        PimAttributeFactory $pimAttributeFactory,
        ExpressionAttributeFactory $expressionAttributeFactory
    ) {
        $this->filterRegistry = $filterRegistry;
        $this->attributeRepository = $attributeRepository;
        $this->pimAttributeFactory = $pimAttributeFactory;
        $this->expressionAttributeFactory = $expressionAttributeFactory;
    }

    public function build()
    {
        $collection = new AttributePairCollection();

        $attributeTypeFilters = $this->getAttributeTypeFilters();
        $attributes = $this->attributeRepository->findAll();

        foreach ($attributes as $attribute) {
            $pimAttributes = $this->getPimAttributes($attribute, $attributeTypeFilters);

            foreach ($pimAttributes as $pimAttribute) {

                $expressionAttributes = $this->expressionAttributeFactory->createAttributesFromPimAttribute($pimAttribute);
                $collection->add($pimAttribute, $expressionAttributes);
            }
        }
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
