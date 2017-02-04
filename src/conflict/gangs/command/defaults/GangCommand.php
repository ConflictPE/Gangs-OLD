<?php

/**
 * Gangs – GangCommand.php
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
 * Created on 29/01/2017 at 7:02 PM
 *
 */

namespace conflict\gangs\command\defaults;

use conflict\gangs\command\UniversalGangsCommand;
use conflict\gangs\Gangs;
use pocketmine\command\CommandSender;

class GangCommand extends UniversalGangsCommand {

	public function __construct(Gangs $plugin, $name, $description = "", $usageMessage = null, array $aliases = []) {
		parent::__construct($plugin, "gang", "Main Gangs command", "/gang <create|join|leave|help>", ["g", "gangs"]);
	}

	public function onCommand(CommandSender $sender, array $args) : bool {
		// TODO: Implement onCommand() method.
		return true; // Shut PHPStorm up
	}

}