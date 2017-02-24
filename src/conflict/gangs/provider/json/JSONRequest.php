<?php

/**
 * Gangs – JSONRequest.php
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
 * Created on 24/02/2017 at 10:14 PM
 *
 */

namespace conflict\gangs\provider\json;

use conflict\gangs\Gangs;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

abstract class JSONRequest extends AsyncTask {

	/** States */
	const SUCCESS = "state.success";
	const JSON_ERROR = "state.json.error";

	public function getPlugin(Server $server) : Gangs {
		return $server->getPluginManager()->getPlugin("Gangs");
	}

	public function checkError(\Throwable $e) {
		$this->setResult([self::JSON_ERROR, $e->getMessage()]);
		return true;
	}

}