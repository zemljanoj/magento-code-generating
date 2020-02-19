<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author    Etendo AB <info@etendo.se>
 */

namespace Mcg\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Main extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('main')
            ->setDescription('main')
            ->setHelp('main');
    }

    /**
     * {@inheritdoc}
     * @throws \Exception
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $output->writeln("<info>Main</info>");
    }
}
