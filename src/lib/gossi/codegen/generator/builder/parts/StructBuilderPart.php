<?php
namespace Mcg\lib\gossi\codegen\generator\builder\parts;

use Mcg\lib\gossi\codegen\generator\ComparatorFactory;
use Mcg\lib\gossi\codegen\model\AbstractModel;
use Mcg\lib\gossi\codegen\model\AbstractPhpStruct;
use Mcg\lib\gossi\codegen\model\ConstantsInterface;
use Mcg\lib\gossi\codegen\model\DocblockInterface;
use Mcg\lib\gossi\codegen\model\NamespaceInterface;
use Mcg\lib\gossi\codegen\model\PropertiesInterface;
use Mcg\lib\gossi\codegen\model\TraitsInterface;

trait StructBuilderPart {
	
	/**
	 * @return void
	 */
	abstract protected function ensureBlankLine();
	
	/**
	 * @param AbstractModel $model
	 * @return void
	 */
	abstract protected function generate(AbstractModel $model);
	
	/**
	 * @param DocblockInterface $model
	 * @return void
	 */
	abstract protected function buildDocblock(DocblockInterface $model);
	
	protected function buildHeader(AbstractPhpStruct $model) {
		$this->buildNamespace($model);
		$this->buildRequiredFiles($model);
		$this->buildUseStatements($model);
		$this->buildDocblock($model);
	}
	
	protected function buildNamespace(NamespaceInterface $model) {
		if ($namespace = $model->getNamespace()) {
			$this->writer->writeln('namespace ' . $namespace . ';');
		}
	}
	
	protected function buildRequiredFiles(AbstractPhpStruct $model) {
		if ($files = $model->getRequiredFiles()) {
			$this->ensureBlankLine();
			foreach ($files as $file) {
				$this->writer->writeln('require_once ' . var_export($file, true) . ';');
			}
		}
	}
	
	protected function buildUseStatements(AbstractPhpStruct $model) {
		if ($useStatements = $model->getUseStatements()) {
			$this->ensureBlankLine();
			foreach ($useStatements as $alias => $namespace) {
				if (false === strpos($namespace, '\\')) {
					$commonName = $namespace;
				} else {
					$commonName = substr($namespace, strrpos($namespace, '\\') + 1);
				}
	
				if (false === strpos($namespace, '\\') && !$model->getNamespace()) {
					//avoid fatal 'The use statement with non-compound name '$commonName' has no effect'
					continue;
				}
	
				$this->writer->write('use ' . $namespace);
	
				if ($commonName !== $alias) {
					$this->writer->write(' as ' . $alias);
				}
	
				$this->writer->writeln(';');
			}
			$this->ensureBlankLine();
		}
	}
	
	protected function buildTraits(TraitsInterface $model) {
		foreach ($model->getTraits() as $trait) {
			$this->writer->write('use ');
			$this->writer->writeln($trait . ';');
		}
	}
	
	protected function buildConstants(ConstantsInterface $model) {
		foreach ($model->getConstants() as $constant) {
			$this->generate($constant);
		}
	}
	
	protected function buildProperties(PropertiesInterface $model) {
		foreach ($model->getProperties() as $property) {
			$this->generate($property);
		}
	}
	
	protected function buildMethods(AbstractPhpStruct $model) {
		foreach ($model->getMethods() as $method) {
			$this->generate($method);
		}
	}
	
	private function sortUseStatements(AbstractPhpStruct $model) {
		if ($this->config->isSortingEnabled() 
				&& ($useStatementSorting = $this->config->getUseStatementSorting()) !== false) {
			if (is_string($useStatementSorting)) {
				$useStatementSorting = ComparatorFactory::createUseStatementComparator($useStatementSorting);
			}
			$model->getUseStatements()->sort($useStatementSorting);
		}
	}
	
	private function sortConstants(ConstantsInterface $model) {
		if ($this->config->isSortingEnabled()
				&& ($constantSorting = $this->config->getConstantSorting()) !== false) {
			if (is_string($constantSorting)) {
				$constantSorting = ComparatorFactory::createConstantComparator($constantSorting);
			}
			$model->getConstants()->sort($constantSorting);
		}
	}
	
	private function sortProperties(PropertiesInterface $model) {
		if ($this->config->isSortingEnabled()
				&& ($propertySorting = $this->config->getPropertySorting()) !== false) {
			if (is_string($propertySorting)) {
				$propertySorting = ComparatorFactory::createPropertyComparator($propertySorting);
			}
			$model->getProperties()->sort($propertySorting);
		}	
	}
		
	private function sortMethods(AbstractPhpStruct $model) {
		if ($this->config->isSortingEnabled()
				&& ($methodSorting = $this->config->getMethodSorting()) !== false) {
			if (is_string($methodSorting)) {
				$methodSorting = ComparatorFactory::createMethodComparator($methodSorting);
			}
			$model->getMethods()->sort($methodSorting);
		}
	}
}
