<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author    Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service\ApiData;

class GetPathService
{
    const DIR = 'Api/Data';

    /**
     * @param string $moduleDir
     * @return string
     */
    public function execute(string $moduleDir): string
    {
        return trim($moduleDir, '/') . '/' . self::DIR;
    }
}
