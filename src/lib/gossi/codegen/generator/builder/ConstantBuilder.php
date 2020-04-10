<?php
namespace Mcg\lib\gossi\codegen\generator\builder;

use Mcg\lib\gossi\codegen\model\AbstractModel;
use Mcg\lib\gossi\codegen\generator\builder\parts\ValueBuilderPart;

class ConstantBuilder extends AbstractBuilder {
	
	use ValueBuilderPart;
	
	public function build(AbstractModel $model) {
		$this->buildDocblock($model);
		$this->writer->write('const ' . $model->getName() . ' = ');
		$this->writeValue($model);
		$this->writer->writeln(';');
	}

}