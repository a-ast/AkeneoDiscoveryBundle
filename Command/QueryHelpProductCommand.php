<?php

namespace Aa\Bundle\AkeneoQueryBundle\Command;

use Aa\Bundle\AkeneoQueryBundle\Attribute\Attribute;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class QueryHelpProductCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('aa:product:query-help')
            ->setDescription('Query products help');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $collectionBuilder = $this->getContainer()->get('aa_query.attribute.collection_builder');
        $collectionBuilder->build();

        $attributes = $collectionBuilder->getAttributes()->getAttributes();
        $operators = $collectionBuilder->getOperators();

        $table = new Table($output);
        $table->setHeaders(['Attribute', 'Operators', 'Functions']);

        foreach ($attributes as $attribute) {

            $attributeOperators = $attribute->getOperators();
            $expressionOperators = $operators->getExpressionOperators($attributeOperators);
            $expressionFunctions = $operators->getExpressionFunctions($attributeOperators);

            $table->addRow([
                $attribute->getName(),
                join(PHP_EOL, $expressionOperators),
                join(PHP_EOL, $expressionFunctions),
            ]);
        }

        $table->render();
    }

}
