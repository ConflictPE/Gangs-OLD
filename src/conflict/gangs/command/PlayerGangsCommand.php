<?php

/**
 * Gangs – PlayerGangsCommand.php
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
 * Created on 29/01/2017 at 5:42 PM
 *
 */

namespace conflict\gangs\command;

use pocketmine\command\CommandSender;
use pocketmine\Player;

/**
 * All commands that are only accessible in-game should extend this class
 */
abstract class PlayerGangsCommand extends GangsCommand {

	protected final function checkSender(CommandSender $sender) : bool {
		return $sender instanceof Player;
	}

}