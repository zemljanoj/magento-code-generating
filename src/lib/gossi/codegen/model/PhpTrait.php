<?php
namespace Mcg\lib\gossi\codegen\model;

use Mcg\lib\gossi\codegen\model\parts\PropertiesPart;
use Mcg\lib\gossi\codegen\model\parts\TraitsPart;
use Mcg\lib\gossi\codegen\parser\FileParser;
use Mcg\lib\gossi\codegen\parser\visitor\ConstantParserVisitor;
use Mcg\lib\gossi\codegen\parser\visitor\MethodParserVisitor;
use Mcg\lib\gossi\codegen\parser\visitor\PropertyParserVisitor;
use Mcg\lib\gossi\codegen\parser\visitor\TraitParserVisitor;

/**
 * Represents a PHP trait.
 *
 * @author Thomas Gossmann
 */
class PhpTrait extends AbstractPhpStruct implements GenerateableInterface, TraitsInterface, PropertiesInterface {

	use PropertiesPart;
	use TraitsPart;

	/**
	 * Creates a PHP trait from a file
	 *
	 * @param string $filename
	 * @return PhpTrait
	 */
	public static function fromFile($filename) {
		$trait = new PhpTrait();
		$parser = new FileParser($filename);
		$parser->addVisitor(new TraitParserVisitor($trait));
		$parser->addVisitor(new MethodParserVisitor($trait));
		$parser->addVisitor(new ConstantParserVisitor($trait));
		$parser->addVisitor(new PropertyParserVisitor($trait));
		$parser->parse();
		
		return $trait;
	}

	/**
	 * Creates a new PHP trait
	 *
	 * @param string $name qualified name
	 */
	public function __construct($name = null) {
		parent::__construct($name);
		$this->initProperties();
	}

	/**
	 * @inheritDoc
	 */
	public function generateDocblock() {
		parent::generateDocblock();

		foreach ($this->properties as $prop) {
			$prop->generateDocblock();
		}
	}
}
