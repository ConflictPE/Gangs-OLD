<?php

/**
 * Gangs – StringEnumFormat.php
 *
 * Copyright (C) 2017 Jack Noordhuis
 *
 * This is private software, you cannot redistribute and/or modify it in any way
 * unless given explicit permission to do so. If you have not been given explicit
 * permission to view or modify this software you should take the appropriate actions
 * to remove this software from your device immediately.
 *
 * @author JackNoordhuis
 *
 * Created on 05/02/2017 at 5:21 PM
 *
 */

namespace conflict\gangs\command\formattable\formats;

use conflict\gangs\command\formattable\Formattable;
use conflict\gangs\command\formattable\FormattableArgument;

class StringEnumFormat extends FormattableArgument {

	const TYPE_COMMAND_NAME = "commandName";
	const TYPE_ENCHANTMENT_TYPE = "enchantmentType";
	const TYPE_BLOCK_TYPE = "blockType";
	const TYPE_ITEM_TYPE = "itemType";
	const TYPE_ENTITY_TYPE = "entityType";

	/** @var string */
	protected $type;

	/** @var array */
	protected $values;

	public function __construct(string $name = "", string $type, bool $optional = false, array $values = []) {
		parent::__construct(Formattable::FORMAT_STRING_ENUM, $name, $optional);
		$this->type = $type;
	}

	public function getType() : string {
		return $this->type;
	}

	public function getValues() : array {
		return $this->values;
	}

	public function parse() : array {
		$data = parent::parse();
		$data["enum_type"] = $this->type;
		if(!empty($this->values)) {
			$data["enum_values"] = [];
			foreach($this->values as $value) {
				$data["enum_values"] = strtolower($value);
			}
		}
		return $data;
	}

}