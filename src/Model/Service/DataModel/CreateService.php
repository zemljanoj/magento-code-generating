<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service\DataModel;

use gossi\codegen\model\PhpClass;
use gossi\codegen\model\PhpInterface;
use gossi\codegen\model\PhpMethod;
use gossi\docblock\Docblock;
use Mcg\Model\Service\ApiData\GetNamespaceService as GetInterfaceNamespaceService;
use Mcg\Model\Service\ApiData\GetPathService as GetInterfacePathService;
use Mcg\Model\Service\FileSystem\CreateFileService;
use Mcg\Model\Service\GetCodeFileGeneratorService;
use Mcg\lib\gossi\dockblock\tags\InheritDocTag;
use Mcg\Model\Service\Method\GetConstNameService;

class CreateService
{
    /**
     * @param string $interfaceName
     * @return string
     * @throws \Exception
     */
    public function execute(string $interfaceName)
    {
        $modelName = str_replace('Interface', '', $interfaceName);

        $getNamespaceService = new GetNamespaceService();
        $nameSpace = $getNamespaceService->execute();
        $qualifiedName = $nameSpace . '\\' . $modelName;

        $getCodeFileGeneratorService =new GetCodeFileGeneratorService();
        $generator = $getCodeFileGeneratorService->execute();

        $class = new PhpClass($qualifiedName);

        $class->setParentClassName('DataObject');
        $class->declareUse('Magento\\Framework\\DataObject');

        $class->setInterfaces([$interfaceName]);
        $class->declareUse('Magento\\Framework\\DataObject');

        $getInterfaceNamespaceService = new GetInterfaceNamespaceService();
        $interfaceNameSpace = $getInterfaceNamespaceService->execute();
        $interfaceQualifiedName = $interfaceNameSpace . '\\' . $interfaceName;
        $class->declareUse($interfaceQualifiedName);

        $getInterfacePathService = new GetInterfacePathService();
        $file = $getInterfacePathService->execute() . '/' . $interfaceName . '.php';
        $interface = PhpInterface::fromFile($file);

        /** @var PhpMethod $interfaceMethod */
        foreach ($interface->getMethods() as $interfaceMethod) {
            $method = new PhpMethod($interfaceMethod->getName());

            $method->setParameters($interfaceMethod->getParameters());
            $method->setVisibility($interfaceMethod->getVisibility());
            $method->setType($interfaceMethod->getType());
            $method->setDocblock($interfaceMethod->getDocblock());

            $getConstNameService = new GetConstNameService();
            $constName = $getConstNameService->execute($method);

            $methodCase = substr($method->getName(),0,3);
            if ($methodCase == 'get') {
                $convert = '';
                if ($type = $this->getType($method)) {
                    $convert = '(' . $type . ')';
                }
                $method->setBody('return ' . $convert . '$this->getData(self::' . $constName . ');');
            }
            if ($methodCase == 'set') {
                $parameterName = $method->getParameter(0)->getName();
                $method->setBody('$this->setData(self::' . $constName . ', $' . $parameterName . ');');
            }

            $class->setMethod($method);
        }

        $code = $generator->generate($class);

        $getPathService = new GetPathService();
        $path = $getPathService->execute();
        $filePath = $path . '/' . $modelName . '.php';
        $createFileService = new CreateFileService();
        $createFileService->execute($filePath, $code);

        return $modelName;
    }

    /**
     * @param PhpMethod $method
     * @return string|null
     */
    private function getType(PhpMethod $method) {
        $type = $method->getType();
        if (!empty($type) && strpos($type, '|') === false) {
            return $type;
        }

        return null;
    }
}
