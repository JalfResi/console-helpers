<?php

namespace Ctrl\Console\Helper;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Output\OutputInterface;

class TableGeneratorHelper extends Helper
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'table_generator';
    }

    /**
     * @param \Traversable $rows
     * @param OutputInterface $output
     * @param callable $mapper
     * @return \Symfony\Component\Console\Helper\Table The table.
     */
    public function generate(\Traversable $rows, OutputInterface $output, $mapper = null)
    {
        /** @var \Symfony\Component\Console\Helper\Table $table */
        $table  = new Table($output);
        $rows   = iterator_to_array($rows);

        if (is_callable($mapper))   { $rows = array_map($mapper, $rows); }
        if (!empty($rows))          { $table->setHeaders(array_keys(current($rows))); }

        $table->addRows($rows);

        return $table;
    }
}
