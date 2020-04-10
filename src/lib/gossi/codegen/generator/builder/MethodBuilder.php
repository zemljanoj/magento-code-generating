<?php
namespace Mcg\lib\gossi\codegen\generator\builder;

use Mcg\lib\gossi\codegen\generator\builder\parts\RoutineBuilderPart;
use Mcg\lib\gossi\codegen\model\AbstractModel;
use Mcg\lib\gossi\codegen\model\PhpInterface;

class MethodBuilder extends AbstractBuilder {
	
	use RoutineBuilderPart;

	public function build(AbstractModel $model) {
		$this->buildDocblock($model);
		
		if ($model->isFinal()) {
			$this->writer->write('final ');
		}
		
		if ($model->isAbstract()) {
			$this->writer->write('abstract ');
		}
		
		$this->writer->write($model->getVisibility() . ' ');
		
		if ($model->isStatic()) {
			$this->writer->write('static ');
		}
		
		$this->writeFunctionStatement($model);
		
		if ($model->isAbstract() || $model->getParent() instanceof PhpInterface) {
			$this->writer->writeln(';');
		
			return;
		}
		
		$this->writeBody($model);
	}

}