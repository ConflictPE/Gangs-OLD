<?php

/**
 * Gangs – CommandArgumentList.php
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
 * Created on 05/02/2017 at 8:22 PM
 *
 */

namespace conflict\gangs\command\formattable\argument;

use conflict\gangs\command\formattable\FormattableArgument;

class CommandArgumentList {

	/** @var CommandArgument */
	private $owner = null;

	/** @var FormattableArgument[] */
	private $list;

	public function __construct(CommandArgument $owner, array $list = []) {
		$this->owner = $owner;
		$this->list = $list;
	}

	public function getOwner() : CommandArgument {
		return $this->owner;
	}

	/**
	 * @return FormattableArgument[]
	 */
	public function getList() : array {
		return $this->list;
	}

	public function getParameters() : array {
		$list = [];
		foreach($this->list as $format) {
			$list[] = $format->parse();
		}
		return $list;
	}

}