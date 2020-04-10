<?php
namespace Mcg\lib\gossi\codegen\generator\builder;

use Mcg\lib\gossi\codegen\model\AbstractModel;
use Mcg\lib\gossi\codegen\generator\builder\parts\ValueBuilderPart;

class PropertyBuilder extends AbstractBuilder {
	
	use ValueBuilderPart;

	public function build(AbstractModel $model) {
		$this->buildDocblock($model);
		
		$this->writer->write($model->getVisibility() . ' ');
		$this->writer->write($model->isStatic() ? 'static ' : '');
		$this->writer->write('$' . $model->getName());
		
		if ($model->hasValue()) {
			$this->writer->write(' = ');
			$this->writeValue($model);
		}
		
		$this->writer->writeln(';');
	}

}