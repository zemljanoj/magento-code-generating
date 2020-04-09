<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service\Method;

use gossi\codegen\model\PhpMethod;

class GetConstNameService
{
    /**
     * @param PhpMethod $method
     * @return string
     */
    public function execute(PhpMethod $method)
    {
        $constName1 = substr($method->getName(), 2);
        $parts1 = preg_split('/(?=[A-Z])/', $constName1);
        $parts2 = [];
        foreach ($parts1 as $index => $part) {
            if ($index === 0) {
                continue;
            }
            $parts2[] = strtoupper($part);
        }

        return implode('_', $parts2);
    }
}
