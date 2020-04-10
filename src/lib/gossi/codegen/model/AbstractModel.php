<?php
namespace Mcg\lib\gossi\codegen\model;

/**
 * Parent of all models
 *
 * @author Thomas Gossmann
 */
abstract class AbstractModel {

	/** @var string */
	protected $description;

	/**
	 * Returns this description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description, which will also be used when generating a docblock
	 *
	 * @param string|array $description
	 * @return $this
	 */
	public function setDescription($description) {
		if (is_array($description)) {
			$description = implode("\n", $description);
		}
		$this->description = $description;
		return $this;
	}

}
