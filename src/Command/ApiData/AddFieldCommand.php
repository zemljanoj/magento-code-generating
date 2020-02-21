<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author    Etendo AB <info@etendo.se>
 */

namespace Mcg\Command\ApiData;

use Mcg\Model\Service\ApiData\AddFieldService;
use Mcg\Model\Service\ApiData\CreateService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AddFieldCommand extends Command
{
    const OPTION_NAME = 'name';

    const OPTION_TYPE = 'type';

    const OPTION_INTERFACE_FILE_PATH = 'file';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('api-data:add-field')
            ->setDescription('Add field to interface.')
            ->addOption(
                self::OPTION_NAME,
                'name',
                InputOption::VALUE_REQUIRED,
                'Field name.'
            )->addOption(
                self::OPTION_TYPE,
                'type',
                InputOption::VALUE_REQUIRED,
                'Field type.'
            )->addOption(
                self::OPTION_INTERFACE_FILE_PATH,
                'file',
                InputOption::VALUE_REQUIRED,
                'Interface file path.'
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
        $type = $input->getOption(self::OPTION_TYPE);
        $file = $input->getOption(self::OPTION_INTERFACE_FILE_PATH);
        $addFieldService = new AddFieldService();
        $addFieldService->execute($name, $type, $file);
        $output->writeln("<info>Added " . $name . " field to " . $file . " interface.</info>");
    }
}
