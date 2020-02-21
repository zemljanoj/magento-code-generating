<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service\ApiData;

use gossi\codegen\model\PhpInterface;
use Mcg\Model\Service\FileSystem\CreateFileService;
use Mcg\Model\Service\GetCodeFileGeneratorService;

class CreateService
{
    public function execute(string $name)
    {
        $interfaceName = $name . 'Interface';
        $getNamespaceService = new GetNamespaceService();
        $nameSpace = $getNamespaceService->execute();
        $qualifiedName = $nameSpace . '\\' . $interfaceName;

        $getCodeFileGeneratorService =new GetCodeFileGeneratorService();
        $generator = $getCodeFileGeneratorService->execute();

        $interface = new PhpInterface($qualifiedName);
        $code = $generator->generate($interface);

        $getPathService = new GetPathService();
        $path = $getPathService->execute();
        $filePath = $path . '/' . $interfaceName . '.php';
        $createFileService = new CreateFileService();
        $createFileService->execute($filePath, $code);
    }
}
