<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author    Etendo AB <info@etendo.se>
 */

namespace Mcg\Command\DataModel;

use Mcg\Model\Service\DataModel\CreateService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends Command
{
    const OPTION_INTERFACE = 'interface';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('data-model:create')
            ->setDescription('Create a data model.')
            ->addOption(
                self::OPTION_INTERFACE,
                'interface',
                InputOption::VALUE_REQUIRED,
                'Interface name.'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $interfaceName = $input->getOption(self::OPTION_INTERFACE);
        $createService = new CreateService();
        $modelName = $createService->execute($interfaceName);
        $output->writeln("<info>Created " . $modelName . " data model.</info>");
    }
}
