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
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;


class QueryProductCommand extends ContainerAwareCommand
{

    protected function configure()
    {

        $this
            ->setName('aa:product:query')
            ->setDescription('Query products');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $converter = $this->getContainer()->get('aa_discovery.expression_to_ast_converter');

        $astNode = $converter->convert('sku > 123 and sku != 888');
        // $converter->dump();

        var_dump($astNode);
    }

}
