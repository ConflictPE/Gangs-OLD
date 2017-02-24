<?php

/**
 * Gangs – DummyCredentials.php
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
 * Created on 24/02/2017 at 10:28 PM
 *
 */

namespace conflict\gangs\provider;

class DummyCredentials {

	/**
	 * Construct a credentials instance from an array
	 *
	 * @param array $data
	 *
	 * @return DummyCredentials
	 */
	public static function fromArray(array $data) {
		return new DummyCredentials();
	}

	/**
	 * Return an array containing all the credentials data
	 *
	 * @return array
	 */
	public function toArray() : array {
		return [];
	}

}