<?php
namespace Mcg\lib\gossi\codegen\generator;

use Mcg\lib\gossi\codegen\generator\builder\AbstractBuilder;
use Mcg\lib\gossi\codegen\generator\builder\ClassBuilder;
use Mcg\lib\gossi\codegen\generator\builder\ConstantBuilder;
use Mcg\lib\gossi\codegen\generator\builder\FunctionBuilder;
use Mcg\lib\gossi\codegen\generator\builder\InterfaceBuilder;
use Mcg\lib\gossi\codegen\generator\builder\MethodBuilder;
use Mcg\lib\gossi\codegen\generator\builder\ParameterBuilder;
use Mcg\lib\gossi\codegen\generator\builder\PropertyBuilder;
use Mcg\lib\gossi\codegen\generator\builder\TraitBuilder;
use Mcg\lib\gossi\codegen\model\AbstractModel;
use Mcg\lib\gossi\codegen\model\PhpClass;
use Mcg\lib\gossi\codegen\model\PhpConstant;
use Mcg\lib\gossi\codegen\model\PhpFunction;
use Mcg\lib\gossi\codegen\model\PhpInterface;
use Mcg\lib\gossi\codegen\model\PhpMethod;
use Mcg\lib\gossi\codegen\model\PhpParameter;
use Mcg\lib\gossi\codegen\model\PhpProperty;
use Mcg\lib\gossi\codegen\model\PhpTrait;

class BuilderFactory {

	/** @var ModelGenerator */
	private $generator;
	
	private $classBuilder;
	private $constantBuilder;
	private $functionBuilder;
	private $interfaceBuilder;
	private $methodBuilder;
	private $parameterBuilder;
	private $propertyBuilder;
	private $traitBuilder;
	
	public function __construct(ModelGenerator $generator) {
		$this->generator = $generator;
		$this->classBuilder = new ClassBuilder($generator);
		$this->constantBuilder = new ConstantBuilder($generator);
		$this->functionBuilder = new FunctionBuilder($generator);
		$this->interfaceBuilder = new InterfaceBuilder($generator);
		$this->methodBuilder = new MethodBuilder($generator);
		$this->parameterBuilder = new ParameterBuilder($generator);
		$this->propertyBuilder = new PropertyBuilder($generator);
		$this->traitBuilder = new TraitBuilder($generator);
	}
	
	/**
	 * Returns the related builder for the given model
	 * 
	 * @param AbstractModel $model
	 * @return AbstractBuilder
	 */
	public function getBuilder(AbstractModel $model) {
		if ($model instanceof PhpClass) {
			return $this->classBuilder;
		}
		
		if ($model instanceof PhpConstant) {
			return $this->constantBuilder;
		}
		
		if ($model instanceof PhpFunction) {
			return $this->functionBuilder;
		}
		
		if ($model instanceof PhpInterface) {
			return $this->interfaceBuilder;
		}
		
		if ($model instanceof PhpMethod) {
			return $this->methodBuilder;
		}
		
		if ($model instanceof PhpParameter) {
			return $this->parameterBuilder;
		}
		
		if ($model instanceof PhpProperty) {
			return $this->propertyBuilder;
		}
		
		if ($model instanceof PhpTrait) {
			return $this->traitBuilder;
		}
		
		return null;
	}
	
}
