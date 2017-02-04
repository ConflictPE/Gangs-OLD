<?php

/**
 * Gangs – Formattable.php
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
 * Created on 30/01/2017 at 8:47 PM
 *
 */

namespace conflict\gangs\command\formattable;

/**
 * Interface that all formattable command arguments must implement
 */
interface Formattable {

	const FORMAT_STRING = 0;
	const FORMAT_STRING_ENUM = 1;
	const FORMAT_RAW_TEXT = 2;
	const FORMAT_INT = 3;
	const FORMAT_TARGET = 4;
	const FORMAT_BLOCK_POSITION = 5;

	public function getFormat() : int;

}