<?php

/**
 * Gangs – HelpSubCommand.php
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
 * Created on 05/02/2017 at 9:35 PM
 *
 */

namespace conflict\gangs\command\formattable\argument\defaults\gang;

use conflict\gangs\command\formattable\argument\CommandArgument;
use conflict\gangs\command\formattable\argument\CommandArgumentList;
use conflict\gangs\command\formattable\format\IntFormat;
use conflict\gangs\command\GangsCommand;
use pocketmine\command\CommandSender;

class HelpSubCommand extends CommandArgument {

	public function __construct(GangsCommand $owner) {
		parent::__construct($owner, "help", new CommandArgumentList($this, [
			new IntFormat("page", true)
		]), "/help [page]", ["h"]);
	}

	public function execute(CommandSender $sender, array $args = []) {
		if(isset($args[0])) {
			$sender->sendMessage("Joining {$args[0]} gang...");
		} else {
			$this->sendUsage($sender);
		}
	}

}