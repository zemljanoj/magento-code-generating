<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author    Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service\Model;

use Exception;
use Mcg\Model\Service\Module\GetPathService as GetModulePathService;

class GetPathService
{
    const DIR = 'Model';

    /**
     * @return string
     * @throws Exception
     */
    public function execute(): string
    {
        $getModulePathService = new GetModulePathService();
        $modulePath = $getModulePathService->execute();

        return $modulePath . '/' . self::DIR;
    }
}
