<?php

/**
 * Gangs – LeaveSubCommand.php
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
 * Created on 05/02/2017 at 9:33 PM
 *
 */

namespace conflict\gangs\command\formattable\argument\defaults\gang;

use conflict\gangs\command\formattable\argument\CommandArgument;
use conflict\gangs\command\formattable\argument\CommandArgumentList;
use conflict\gangs\command\formattable\format\StringFormat;
use conflict\gangs\command\GangsCommand;
use pocketmine\command\CommandSender;

class LeaveSubCommand extends CommandArgument {

	public function __construct(GangsCommand $owner) {
		parent::__construct($owner, "leave", new CommandArgumentList($this, [
			new StringFormat("leave")
		]), "/gang leave", ["quit"]);
	}

	public function execute(CommandSender $sender, array $args = []) {
		if(isset($args[0])) {
			$sender->sendMessage("Leaving gang...");
		} else {
			$this->sendUsage($sender);
		}
	}

}