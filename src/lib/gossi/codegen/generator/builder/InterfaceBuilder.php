<?php
namespace Mcg\lib\gossi\codegen\generator\builder;

use Mcg\lib\gossi\codegen\generator\builder\parts\StructBuilderPart;
use Mcg\lib\gossi\codegen\model\AbstractModel;
use Mcg\lib\gossi\codegen\model\PhpInterface;

class InterfaceBuilder extends AbstractBuilder {

	use StructBuilderPart;
	
	public function build(AbstractModel $model) {
		$this->sort($model);
	
		$this->buildHeader($model);
		
		// signature
		$this->buildSignature($model);
	
		// body
		$this->writer->writeln(" {\n")->indent();
		$this->buildConstants($model);
		$this->buildMethods($model);
		$this->writer->outdent()->rtrim()->write('}');
	}
	
	private function buildSignature(PhpInterface $model) {
		$this->writer->write('interface ');
		$this->writer->write($model->getName());
		
		if ($model->hasInterfaces()) {
			$this->writer->write(' extends ');
			$this->writer->write(implode(', ', $model->getInterfaces()->toArray()));
		}
	}
	
	private function sort(PhpInterface $model) {
		$this->sortUseStatements($model);
		$this->sortConstants($model);
		$this->sortMethods($model);
	}
}