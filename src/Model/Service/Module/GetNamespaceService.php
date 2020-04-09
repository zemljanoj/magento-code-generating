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
        $moduleName = $this->formatName($moduleName);
        $vendorName = array_pop($pathSections);
        $vendorName = $this->formatName($vendorName);

        return $vendorName . '\\' . $moduleName;
    }

    /**
     * @param string $name
     * @return string
     */
    private function formatName (string $name)
    {
        $parts = explode('-', $name);
        $formatedName = '';
        foreach ($parts as $part) {
            $formatedName .= ucfirst($part);
        }

        return $formatedName;
    }
}
