<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author    Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service\Module;

use Exception;

class GetNamespaceService
{
    /**
     * @param string $path
     * @return string
     */
    public function execute(string $path): string
    {
        $pathSections = explode('/', $path);
        $moduleName = array_pop($pathSections);
        $vendorName = array_pop($pathSections);

        return $vendorName . '\\' . $moduleName;
    }
}
