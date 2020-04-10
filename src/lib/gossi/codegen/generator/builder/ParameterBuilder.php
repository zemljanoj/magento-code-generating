<?php

namespace Mcg\lib\gossi\codegen\generator\builder;

use Mcg\lib\gossi\codegen\generator\builder\parts\TypeBuilderPart;
use Mcg\lib\gossi\codegen\generator\builder\parts\ValueBuilderPart;
use Mcg\lib\gossi\codegen\model\AbstractModel;

class ParameterBuilder extends AbstractBuilder
{

    use ValueBuilderPart;
    use TypeBuilderPart;

    public function build(AbstractModel $model)
    {
        $type = $this->getType($model, $this->config->getGenerateScalarTypeHints());
        // start rewrite
        if (strpos($type, '[') !== false) {
            $type = 'array';
        }
        // end rewrite
        if ($type !== null) {
            $this->writer->write($type . ' ');
        }

        if ($model->isPassedByReference()) {
            $this->writer->write('&');
        }

        $this->writer->write('$' . $model->getName());

        if ($model->hasValue()) {
            $this->writer->write(' = ');

            $this->writeValue($model);
        }
    }

}