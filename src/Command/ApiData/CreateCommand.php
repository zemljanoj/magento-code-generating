<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author    Etendo AB <info@etendo.se>
 */

namespace Mcg\Command\ApiData;

use Mcg\Model\Data\ApiData\CreateInputData;
use Mcg\Model\Service\ApiData\CreateService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('api-data:create')
            ->setDescription('Create an api data interface.')
            ->setHelp('Create an api data interface.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $output->writeln("<info>Create an api data interface.</info>");
        $createInputData = new CreateInputData();
        $createInputData->setName($name);
        $createService = new CreateService();
        $createService->execute($createInputData);
    }
}
