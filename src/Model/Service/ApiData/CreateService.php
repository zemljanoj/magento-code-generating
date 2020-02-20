<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service\ApiData;

use gossi\codegen\generator\CodeFileGenerator;
use gossi\codegen\generator\CodeGenerator;
use gossi\codegen\model\PhpInterface;
use Mcg\Model\Service\FileSystem\CreateFileService;

class CreateService
{
    public function execute(string $name)
    {
        $interfaceName = $name . 'Interface';
        $getNamespaceService = new GetNamespaceService();
        $nameSpace = $getNamespaceService->execute();
        $qualifiedName = $nameSpace . '\\' . $interfaceName;

        $interface = new PhpInterface($qualifiedName);
        $generator = new CodeFileGenerator();
        $generator->getConfig()->setGenerateEmptyDocblock(false);
        $code = $generator->generate($interface);

        $getPathService = new GetPathService();
        $path = $getPathService->execute();
        $filePath = $path . '/' . $interfaceName . '.php';
        $createFileService = new CreateFileService();
        $createFileService->execute($filePath, $code);
    }
}
