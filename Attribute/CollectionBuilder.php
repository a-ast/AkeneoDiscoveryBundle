<?php

namespace Aa\Bundle\AkeneoQueryBundle\Attribute;

use Pim\Component\Catalog\Model\AttributeInterface;
use Pim\Component\Catalog\Query\Filter\FilterRegistryInterface;
use Pim\Component\Catalog\Repository\AttributeRepositoryInterface;

class CollectionBuilder
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
     * @var AttributeFactory
     */
    private $attributeFactory;

    /**
     * @var AttributeCollection
     */
    private $attributes;

    /**
     * @var OperatorCollection
     */
    private $operators;

    public function __construct(
        FilterRegistryInterface $filterRegistry,
        AttributeRepositoryInterface $attributeRepository,
        AttributeFactory $attributeFactory
    ) {
        $this->filterRegistry = $filterRegistry;
        $this->attributeRepository = $attributeRepository;
        $this->attributeFactory = $attributeFactory;
        $this->attributes = new AttributeCollection();
        $this->operators = new OperatorCollection();
    }

    public function build()
    {
        $attributes = $this->attributeRepository->findAll();

        foreach ($attributes as $attribute) {
            $pimAttributes = $this->getPimAttributes($attribute);

            foreach ($pimAttributes as $pimAttribute) {

                $this->attributes->add($pimAttribute);

                foreach ($pimAttribute->getOperators() as $operator) {
                    $this->operators->add($operator);
                }

            }
        }
    }

    /**
     * @return Attribute[]
     */
    private function getPimAttributes(AttributeInterface $attribute): array
    {
        $pimAttributes = [];

        $attributeTypeFilters = $this->getAttributeTypeFilters();

        if (array_key_exists($attribute->getType(), $attributeTypeFilters)) {
            foreach ($attributeTypeFilters[$attribute->getType()] as $filter) {
                $pimAttributes[] = $this->attributeFactory->create($attribute, $filter);
            }

            return $pimAttributes;
        }

        if ($attribute->isBackendTypeReferenceData()) {
            foreach ($this->filterRegistry->getAttributeFilters() as $filter) {
                if (!$filter->supportsAttribute($attribute)) {
                    continue;
                }

                $pimAttributes[] = $this->attributeFactory->create($attribute, $filter);
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

    public function getAttributes(): AttributeCollection
    {
        return $this->attributes;
    }

    public function getOperators(): OperatorCollection
    {
        return $this->operators;
    }
}
