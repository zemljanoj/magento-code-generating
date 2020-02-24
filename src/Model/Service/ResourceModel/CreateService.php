<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service\ResourceModel;

use gossi\codegen\model\PhpClass;
use gossi\codegen\model\PhpMethod;
use gossi\docblock\Docblock;
use gossi\docblock\tags\UnknownTag;
use Mcg\Model\Service\FileSystem\CreateFileService;
use Mcg\Model\Service\GetCodeFileGeneratorService;

class CreateService
{
    public function execute(string $name, string $table, string $idField)
    {
        $getNamespaceService = new GetNamespaceService();
        $nameSpace = $getNamespaceService->execute();
        $qualifiedName = $nameSpace . '\\' . $name;

        $getCodeFileGeneratorService =new GetCodeFileGeneratorService();
        $generator = $getCodeFileGeneratorService->execute();

        $class = new PhpClass($qualifiedName);
        $method = new PhpMethod('_construct');
        $method->setVisibility(PhpMethod::VISIBILITY_PROTECTED);
        $dockBlock = new Docblock();
        $inheritDocTag = new UnknownTag('inheritDoc');
        $dockBlock->appendTag($inheritDocTag);
        $method->setDocblock($dockBlock);
        $method->setBody('$this->_init(\'' . $table . '\', \'' . $idField . '\');');
        $class->setMethod($method);
        $class->setParentClassName('AbstractDb');
        $class->declareUse('Magento\\Framework\\Model\\ResourceModel\\Db\\AbstractDb');
        $code = $generator->generate($class);

        $getPathService = new GetPathService();
        $path = $getPathService->execute();
        $filePath = $path . '/' . $name . '.php';
        $createFileService = new CreateFileService();
        $createFileService->execute($filePath, $code);
    }
}
