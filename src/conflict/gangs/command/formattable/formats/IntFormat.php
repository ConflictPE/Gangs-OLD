<?php

/**
 * Gangs – IntFormat.php
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
 * Created on 05/02/2017 at 5:36 PM
 *
 */

namespace conflict\gangs\command\formattable\formats;

use conflict\gangs\command\formattable\Formattable;
use conflict\gangs\command\formattable\FormattableArgument;

class IntFormat extends FormattableArgument {

	public function __construct(string $format, string $name = "", bool $optional = false) {
		parent::__construct(Formattable::FORMAT_INT, $name, $optional);
	}

}