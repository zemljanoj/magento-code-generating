<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service\ApiData;

use gossi\codegen\model\PhpInterface;
use gossi\codegen\model\PhpMethod;
use gossi\codegen\model\PhpParameter;
use Mcg\Model\Service\FileSystem\CreateFileService;
use Mcg\Model\Service\GetCodeFileGeneratorService;

class AddFieldService
{
    /**
     * @param string $name
     * @param string $type
     * @param string $file
     * @return void
     */
    public function execute(string $name, string $type, string $file)
    {
        $getCodeFileGeneratorService =new GetCodeFileGeneratorService();
        $generator = $getCodeFileGeneratorService->execute();

        $interface = PhpInterface::fromFile($file);

        $constantName = strtoupper($name);
        $interface->setConstant($constantName, $name);

        $this->addSetMethod($interface, $name, $type);
        $this->addGetMethod($interface, $name, $type);

        $code = $generator->generate($interface);

        $createFileService = new CreateFileService();
        $createFileService->execute($file, $code);
    }

    /**
     * @param PhpInterface $interface
     * @param string $name
     * @param string $type
     * @return void
     */
    private function addSetMethod(PhpInterface $interface, string $name, string $type)
    {
        $seMethodName = $this->getMethodName('set', $name);
        $setMethod = new PhpMethod($seMethodName);
        $parameter = new PhpParameter();
        $parameter->setName('value');
        $parameter->setType($type);
        $setMethod->addParameter($parameter);
        $interface->setMethod($setMethod);
    }

    /**
     * @param PhpInterface $interface
     * @param string $name
     * @param string $type
     * @return void
     */
    private function addGetMethod(PhpInterface $interface, string $name, string $type)
    {
        $seMethodName = $this->getMethodName('get', $name);
        $setMethod = new PhpMethod($seMethodName);
        $setMethod->setType($type);
        $interface->setMethod($setMethod);
    }

    /**
     * @param string $prefix
     * @param string $name
     * @return string
     */
    private function getMethodName(string $prefix, string $name)
    {
        $methodName = $prefix;
        $sections = explode('_', $name);
        foreach ($sections as $section) {
            $methodName .= ucfirst($section);
        }

        return $methodName;
    }
}
