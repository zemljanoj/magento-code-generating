<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author    Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service\ResourceModel;

use Exception;
use Mcg\Model\Service\Module\GetNamespaceService as GetModuleNamespaceService;
use Mcg\Model\Service\Module\GetPathService as GetModulePathService;

class GetNamespaceService
{
    const NAMESPACE_SECTION = 'Model\\ResourceModel';

    /**
     * @return string
     * @throws Exception
     */
    public function execute(): string
    {
        $getModulePathService = new GetModulePathService();
        $modulePath = $getModulePathService->execute();
        $getModuleNamespace = new GetModuleNamespaceService();
        $moduleNamespace = $getModuleNamespace->execute($modulePath);

        return $moduleNamespace . '\\' . self::NAMESPACE_SECTION;
    }
}
