<?php
/**
 * @copyright Copyright (c) 2016-2020 Etendo <etendo.se>. All rights reserved.
 * @author Etendo AB <info@etendo.se>
 */

namespace Mcg\lib\gossi\dockblock\tags;

use gossi\docblock\tags\AbstractTypeTag;

class InheritDocTag extends AbstractTypeTag
{
    public function __construct() {
        parent::__construct('inheritDoc');
    }

    /**
     * @return string
     */
    public function toString() {
        return sprintf('{@%s %s}', $this->tagName, $this->description);
    }
}
