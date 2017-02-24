<?php

/**
 * Gangs – CreateRequest.php
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
 * Created on 24/02/2017 at 10:22 PM
 *
 */

namespace conflict\gangs\provider\json\tasks;

use conflict\gangs\provider\json\JSONCredentials;
use conflict\gangs\provider\json\JSONRequest;
use pocketmine\Server;

class CreateRequest extends JSONRequest {

	/** @var string */
	private $path;

	public function __construct(JSONCredentials $credentials) {
		$this->path = $credentials->path;
	}

	public function onRun() {

	}

	public function onCompletion(Server $server) {

	}

}