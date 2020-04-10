<?php
namespace Mcg\lib\gossi\codegen\generator\builder;

use Mcg\lib\gossi\codegen\model\AbstractModel;
use Mcg\lib\gossi\codegen\generator\builder\parts\StructBuilderPart;
use Mcg\lib\gossi\codegen\model\PhpTrait;

class TraitBuilder extends AbstractBuilder {

	use StructBuilderPart;
	
	public function build(AbstractModel $model) {
		$this->sort($model);
	
		$this->buildHeader($model);
	
		// signature
		$this->buildSignature($model);
	
		// body
		$this->writer->writeln(" {\n")->indent();
		$this->buildTraits($model);
		$this->buildProperties($model);
		$this->buildMethods($model);
		$this->writer->outdent()->rtrim()->write('}');
	}
	
	private function buildSignature(PhpTrait $model) {
		$this->writer->write('trait ');
		$this->writer->write($model->getName());
	}
	
	private function sort(PhpTrait $model) {
		$this->sortUseStatements($model);
		$this->sortProperties($model);
		$this->sortMethods($model);
	}
}