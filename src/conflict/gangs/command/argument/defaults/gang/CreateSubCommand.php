<?php

/**
 * Gangs – CreateSubCommand.php
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
 * Created on 05/02/2017 at 7:32 PM
 *
 */

namespace conflict\gangs\command\argument\defaults\gang;

use conflict\gangs\command\argument\CommandArgument;
use conflict\gangs\command\GangsCommand;
use pocketmine\command\CommandSender;

class CreateSubCommand extends CommandArgument {

	public function __construct(GangsCommand $owner) {
		parent::__construct($owner, "create", "/gang create <name>", ["new", "open"]);
	}

	public function execute(CommandSender $sender, array $args = []) {
		if(isset($args[0])) {
			$sender->sendMessage("Creating {$args[0]} gang...");
		} else {
			$this->sendUsage($sender);
		}
	}

}