<?php

namespace Aa\Bundle\AkeneoQueryBundle\Command;

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
        $toAstConverter = $this->getContainer()->get('aa_discovery.query.expression_to_ast_converter');
        $fromAstConverter = $this->getContainer()->get('aa_discovery.query.ast_to_filters_converter');

        $expression = $input->getArgument('expression');

        $astNode = $toAstConverter->convert($expression);
        $filters = $fromAstConverter->convert($astNode);

        foreach ($filters as $filter) {
            $output->writeln((string)$filter);
        }
    }

}
