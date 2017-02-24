<?php

/**
 * Gangs – JSONCredentials.php
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
 * Created on 24/02/2017 at 10:23 PM
 *
 */

namespace conflict\gangs\provider\json;

use conflict\gangs\provider\DummyCredentials;

class JSONCredentials extends DummyCredentials {

	/** @var string */
	public $path;

	public static function fromArray(array $data) : JSONCredentials {
		$instance = new JSONCredentials();
		$instance->path = $data["path"];
		return $instance;
	}

	public function toArray() : array {
		return [
			"path" => $this->path
		];
	}

}