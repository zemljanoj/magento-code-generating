<?php
namespace Mcg\lib\gossi\codegen\parser\visitor\parts;

use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\TraitUse;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\UseUse;
use Mcg\lib\gossi\codegen\model\AbstractPhpStruct;

trait StructParserPart {
	
	/**
	 * @return AbstractPhpStruct
	 */
	abstract protected function getStruct();
	
	public function visitStruct(ClassLike $node) {
		$struct = $this->getStruct();
		$struct->setName($node->name);
	
		if (($doc = $node->getDocComment()) !== null) {
			$struct->setDocblock($doc->getReformattedText());
			$docblock = $struct->getDocblock();
			$struct->setDescription($docblock->getShortDescription());
			$struct->setLongDescription($docblock->getLongDescription());
		}
	}
	
	public function visitTraitUse(TraitUse $node) {
		$struct = $this->getStruct();
		
		foreach ($node->traits as $trait) {
			$struct->addTrait(implode('\\', $trait->parts));
		}
	}
	
	public function visitNamespace(Namespace_ $node) {
		if ($node->name !== null) {
			$this->getStruct()->setNamespace(implode('\\', $node->name->parts));
		}
	}
	
	public function visitUseStatement(UseUse $node) {
		$name = implode('\\', $node->name->parts);
		$alias = !empty($node->alias) ? $node->alias : null;
	
		$this->getStruct()->addUseStatement($name, $alias);
	}
	
}