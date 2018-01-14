<?php

namespace Aa\Bundle\AkeneoQueryBundle\Command;

use Aa\Bundle\AkeneoQueryBundle\Attribute\PimAttribute;
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
        $rows = $this->getContainer()->get('aa_discovery.query.attribute_operator_map')->getMap();

        $table = new Table($output);
        $table->setHeaders(['Attribute', 'l', 's' ,'Operators']);

        /** @var PimAttribute $attribute */
        foreach ($rows as $attribute) {
            $table->addRow([
                $attribute->getName(),
                $attribute->isLocalizable(),
                $attribute->isScopable(),
                join(PHP_EOL, $attribute->getOperators()),
            ]);
        }

        $table->render();
    }

}
