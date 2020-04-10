<?php
namespace Mcg\lib\gossi\codegen\parser\visitor\parts;

use PhpParser\Comment\Doc;
use Mcg\lib\gossi\codegen\model\AbstractPhpMember;
use PhpParser\Node;

trait MemberParserPart {
	
	private function parseMemberDocblock($member, Doc $doc = null) {
		if ($doc !== null) {
			$member->setDocblock($doc->getReformattedText());
			$docblock = $member->getDocblock();
			$member->setDescription($docblock->getShortDescription());
			$member->setLongDescription($docblock->getLongDescription());
	
			$vars = $docblock->getTags('var');
			if ($vars->size() > 0) {
				$var = $vars->get(0);
				$member->setType($var->getType(), $var->getDescription());
			}
		}
	}
	
	/**
	 * Returns the visibility from a node
	 *
	 * @param Node $node
	 * @return string
	 */
	private function getVisibility(Node $node) {
		if ($node->isPrivate()) {
			return AbstractPhpMember::VISIBILITY_PRIVATE;
		}
	
		if ($node->isProtected()) {
			return AbstractPhpMember::VISIBILITY_PROTECTED;
		}
	
		return AbstractPhpMember::VISIBILITY_PUBLIC;
	}
}