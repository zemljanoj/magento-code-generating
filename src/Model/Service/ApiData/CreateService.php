<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service\ApiData;

use gossi\codegen\generator\CodeGenerator;
use gossi\codegen\model\PhpInterface;

class CreateService
{
    public function execute(string $name)
    {
        $interfaceName = $name . 'Interface';
        $getNamespaceService = new GetNamespaceService();
        $nameSpace = $getNamespaceService->execute();
        $qualifiedName = $nameSpace . '\\' . $interfaceName;
        $interface = new PhpInterface($qualifiedName);
        $generator = new CodeGenerator();
        $generator->getConfig()->setGenerateEmptyDocblock(false);
        $code = $generator->generate($interface);

        var_dump(
            $code
        );
    }
}
