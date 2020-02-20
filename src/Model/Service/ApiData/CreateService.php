<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service\ApiData;

use gossi\codegen\generator\CodeGenerator;
use gossi\codegen\model\PhpClass;
use gossi\codegen\model\PhpMethod;
use gossi\codegen\model\PhpParameter;
use Mcg\Model\Data\ApiData\CreateInputData;

class CreateService
{
    public function execute(CreateInputData $createInputData)
    {
        $class = new PhpClass();
        $class
            ->setQualifiedName('my\\cool\\Tool')
            ->setMethod(PhpMethod::create('__construct')
                ->addParameter(PhpParameter::create('target')
                    ->setType('string')
                    ->setDescription('Creates my Tool')
                )
            )
        ;

        $generator = new CodeGenerator();
        $code = $generator->generate($class);
    }
}
