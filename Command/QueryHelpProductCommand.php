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
        $this->getContainer()->get('aa_query.attribute.collection_builder')->build();

        $attributeCollection = $this->getContainer()->get('aa_query.attribute.collection');
        $attributes = $attributeCollection->getAttributes();

        $table = new Table($output);
        $table->setHeaders(['Attribute', 'Operators']);

        foreach ($attributes as $attribute) {
            $table->addRow([
                $attribute->getName(),
                join(PHP_EOL, $attribute->getOperators()),
            ]);
        }

        $table->render();
    }

}
