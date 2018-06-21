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
        $textToAstConverter = $this->getContainer()->get('aa_query.query.expression_to_ast_converter');
        $astToFiltersConverter = $this->getContainer()->get('aa_query.query.ast_to_filters_converter');

        $expression = $input->getArgument('expression');

        $astNode = $textToAstConverter->convert($expression);
        $filters = $astToFiltersConverter->convert($astNode);

        // @todo: convert filters to PIM entities again

        foreach ($filters as $filter) {
            $output->writeln((string)$filter);
            //var_dump($filter);
        }
    }

    protected function getProductQueryBuilder(array $filters)
    {
        $factory = $this->getContainer()->get('pim_catalog.query.product_query_builder_factory');

        return $factory->create(['filters' => $filters]);
    }
}
