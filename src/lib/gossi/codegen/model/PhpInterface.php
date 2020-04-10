<?php
namespace Mcg\lib\gossi\codegen\model;

use Mcg\lib\gossi\codegen\model\parts\ConstantsPart;
use Mcg\lib\gossi\codegen\model\parts\InterfacesPart;
use Mcg\lib\gossi\codegen\parser\FileParser;
use Mcg\lib\gossi\codegen\parser\visitor\ConstantParserVisitor;
use Mcg\lib\gossi\codegen\parser\visitor\InterfaceParserVisitor;
use Mcg\lib\gossi\codegen\parser\visitor\MethodParserVisitor;

/**
 * Represents a PHP interface.
 *
 * @author Thomas Gossmann
 */
class PhpInterface extends AbstractPhpStruct implements GenerateableInterface, ConstantsInterface {

	use ConstantsPart;
	use InterfacesPart;

	/**
	 * Creates a PHP interface from file
	 *
	 * @param string $filename
	 * @return PhpInterface
	 */
	public static function fromFile($filename) {
		$interface = new PhpInterface();
		$parser = new FileParser($filename);
		$parser->addVisitor(new InterfaceParserVisitor($interface));
		$parser->addVisitor(new MethodParserVisitor($interface));
		$parser->addVisitor(new ConstantParserVisitor($interface));
		$parser->parse();
		
		return $interface;
	}

	/**
	 * Create a new PHP interface
	 *
	 * @param string $name qualified name
	 */
	public function __construct($name = null) {
		parent::__construct($name);
		$this->initConstants();
		$this->initInterfaces();
	}

	/**
	 * @inheritDoc
	 */
	public function generateDocblock() {
		parent::generateDocblock();

		foreach ($this->constants as $constant) {
			$constant->generateDocblock();
		}
	}
}
