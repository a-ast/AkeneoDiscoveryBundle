<?php

namespace Aa\Bundle\AkeneoDiscoveryBundle\Command;

use Akeneo\Component\StorageUtils\Cursor\CursorInterface;
use Pim\Component\Catalog\Query\ProductQueryBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\HelperInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class QueryProductCommand extends ContainerAwareCommand
{
    protected function configure()
    {

        $this
            ->setName('aa:product:query')
            ->setDescription('Query products')
            ->addArgument('expression', InputArgument::REQUIRED);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $converter = $this->getContainer()->get('aa_discovery.query.expression_to_ast_converter');

        $expression = $input->getArgument('expression');

        $astNode = $converter->convert($expression);

        var_dump($astNode);
    }

}
