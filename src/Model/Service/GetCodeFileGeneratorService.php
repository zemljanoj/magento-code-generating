<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author Etendo AB <info@etendo.se>
 */

namespace Mcg\Model\Service;

use Mcg\lib\gossi\codegen\generator\CodeFileGenerator;
use gossi\docblock\Docblock;
use gossi\docblock\tags\AuthorTag;
use gossi\docblock\tags\UnknownTag;

class GetCodeFileGeneratorService
{
    /**
     * @return CodeFileGenerator
     */
    public function execute()
    {
        $generator = new CodeFileGenerator([
            'generateScalarTypeHints' => true,
            'generateReturnTypeHints' => true,
            'declareStrictTypes' => true
        ]);
        $header = new Docblock();
        $copyrightTag = new UnknownTag('copyright', 'Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.');
        $header->appendTag($copyrightTag);
        $authorTag = new AuthorTag();
        $authorTag->setName('Etendo AB');
        $authorTag->setEmail('info@etendo.se');
        $header->appendTag($authorTag);
        $generator->getConfig()->setHeaderDocblock($header);
        $generator->getConfig()->setGenerateEmptyDocblock(false);


        return $generator;
    }
}
