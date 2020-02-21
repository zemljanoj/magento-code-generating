<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author    Etendo AB <info@etendo.se>
 */

namespace Mcg\Command\ApiData;

use Mcg\Model\Service\ApiData\CreateService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends Command
{
    const OPTION_NAME = 'name';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('api-data:create')
            ->setDescription('Create an api data interface.')
            ->addOption(
                self::OPTION_NAME,
                'name',
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
        $name = $input->getOption(self::OPTION_NAME);
        $createService = new CreateService();
        $createService->execute($name);
        $output->writeln("<info>Created " . $name . " api data interface.</info>");
    }
}
