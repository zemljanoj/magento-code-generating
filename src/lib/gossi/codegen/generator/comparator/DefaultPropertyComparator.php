<?php
namespace Mcg\lib\gossi\codegen\generator\comparator;

use Mcg\lib\gossi\codegen\model\PhpProperty;
use phootwork\lang\Comparator;

/**
 * Default property comparator
 * 
 * Orders them by visibility first then by method name
 */
class DefaultPropertyComparator implements Comparator {

	/**
	 * @param PhpProperty $a
	 * @param PhpProperty $b
	 */
	public function compare($a, $b) {
		if (($aV = $a->getVisibility()) !== $bV = $b->getVisibility()) {
			$aV = 'public' === $aV ? 3 : ('protected' === $aV ? 2 : 1);
			$bV = 'public' === $bV ? 3 : ('protected' === $bV ? 2 : 1);
		
			return $aV > $bV ? -1 : 1;
		}
		
		return strcasecmp($a->getName(), $b->getName());
	}

}