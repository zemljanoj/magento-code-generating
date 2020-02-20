<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author    Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service\Module;

use Exception;

class GetPathService
{
    /**
     * @return string
     * @throws Exception
     */
    public function execute(): string
    {
        if (!$path = getcwd()) {
            throw new Exception('Cannot detect the module path.');
        }
        return $path;
    }
}
