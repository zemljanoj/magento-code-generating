<?php
namespace Mcg\lib\gossi\codegen\model;

use Mcg\lib\gossi\codegen\model\parts\AbstractPart;
use Mcg\lib\gossi\codegen\model\parts\ConstantsPart;
use Mcg\lib\gossi\codegen\model\parts\FinalPart;
use Mcg\lib\gossi\codegen\model\parts\InterfacesPart;
use Mcg\lib\gossi\codegen\model\parts\PropertiesPart;
use Mcg\lib\gossi\codegen\model\parts\TraitsPart;
use Mcg\lib\gossi\codegen\parser\FileParser;
use Mcg\lib\gossi\codegen\parser\visitor\ClassParserVisitor;
use Mcg\lib\gossi\codegen\parser\visitor\ConstantParserVisitor;
use Mcg\lib\gossi\codegen\parser\visitor\MethodParserVisitor;
use Mcg\lib\gossi\codegen\parser\visitor\PropertyParserVisitor;

/**
 * Represents a PHP class.
 *
 * @author Thomas Gossmann
 */
class PhpClass extends AbstractPhpStruct implements GenerateableInterface, TraitsInterface, ConstantsInterface, PropertiesInterface {

	use AbstractPart;
	use ConstantsPart;
	use FinalPart;
	use InterfacesPart;
	use PropertiesPart;
	use TraitsPart;

	/** @var string */
	private $parentClassName;

	/**
	 * Creates a PHP class from file
	 *
	 * @param string $filename
	 * @return PhpClass
	 */
	public static function fromFile($filename) {
		$class = new PhpClass();
		$parser = new FileParser($filename);
		$parser->addVisitor(new ClassParserVisitor($class));
		$parser->addVisitor(new MethodParserVisitor($class));
		$parser->addVisitor(new ConstantParserVisitor($class));
		$parser->addVisitor(new PropertyParserVisitor($class));
		$parser->parse();
		
		return $class;
	}

	/**
	 * Creates a new PHP class
	 *
	 * @param string $name the qualified name
	 */
	public function __construct($name = null) {
		parent::__construct($name);
		$this->initProperties();
		$this->initConstants();
		$this->initInterfaces();
	}

	/**
	 * Returns the parent class name
	 *
	 * @return string
	 */
	public function getParentClassName() {
		return $this->parentClassName;
	}

	/**
	 * Sets the parent class name
	 *
	 * @param string|null $name the new parent
	 * @return $this
	 */
	public function setParentClassName($name) {
		$this->parentClassName = $name;

		return $this;
	}

	public function generateDocblock() {
		parent::generateDocblock();

		foreach ($this->constants as $constant) {
			$constant->generateDocblock();
		}

		foreach ($this->properties as $prop) {
			$prop->generateDocblock();
		}
	}

}
