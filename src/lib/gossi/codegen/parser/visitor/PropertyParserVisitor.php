<?php
namespace Mcg\lib\gossi\codegen\parser\visitor;

use Mcg\lib\gossi\codegen\model\PhpProperty;
use Mcg\lib\gossi\codegen\parser\visitor\parts\MemberParserPart;
use Mcg\lib\gossi\codegen\parser\visitor\parts\ValueParserPart;
use PhpParser\Node\Stmt\Property;

class PropertyParserVisitor extends StructParserVisitor {
	
	use ValueParserPart;
	use MemberParserPart;
	
	public function visitProperty(Property $node) {
		$prop = $node->props[0];
		
		$p = new PhpProperty($prop->name);
		$p->setStatic($node->isStatic());
		$p->setVisibility($this->getVisibility($node));
		
		$this->parseValue($p, $prop);
		$this->parseMemberDocblock($p, $node->getDocComment());
		
		$this->struct->setProperty($p);
	}
	
}