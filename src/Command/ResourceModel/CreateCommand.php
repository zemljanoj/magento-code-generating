<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author    Etendo AB <info@etendo.se>
 */

namespace Mcg\Command\ResourceModel;

use Mcg\Model\Service\ResourceModel\CreateService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends Command
{
    const OPTION_NAME = 'name';

    const OPTION_TABLE_NAME = 'table';

    const OPTION_ID_FIELD_NAME = 'id';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('resource-model:create')
            ->setDescription('Create an resource model.')
            ->addOption(
                self::OPTION_NAME,
                'name',
                InputOption::VALUE_REQUIRED,
                'Resource model name.'
            )->addOption(
                self::OPTION_TABLE_NAME,
                'table',
                InputOption::VALUE_REQUIRED,
                'Table name.'
            )->addOption(
                self::OPTION_ID_FIELD_NAME,
                'id',
                InputOption::VALUE_REQUIRED,
                'Identifier field name.'
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
        $table = $input->getOption(self::OPTION_TABLE_NAME);
        $idField = $input->getOption(self::OPTION_ID_FIELD_NAME);
        $createService = new CreateService();
        $createService->execute($name, $table, $idField);
        $output->writeln("<info>Created " . $name . " resource model.</info>");
    }
}
