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

namespace conflict\gangs\command\argument\defaults\gang;

use conflict\gangs\command\argument\CommandArgument;
use conflict\gangs\command\GangsCommand;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class HelpSubCommand extends CommandArgument {

	public function __construct(GangsCommand $owner) {
		parent::__construct($owner, "help", "/help [page]", "List all gang commands and their descriptions", ["h"]);
	}

	public function execute(CommandSender $sender, array $args = []) {
		if(isset($args[0])) {
			try {
				$page = (int) $args[0];
			} catch(\Throwable $e) {
				$sender->sendMessage(TextFormat::RED . "Page must be a number!");
				return true;
			}
			if($page <= 0) {
				$sender->sendMessage(TextFormat::RED . "Page must be more than zero!");
				return true;
			}
		} else {
			$page = 1;
		}

		$highest = $page * 7;
		$lowest = $highest - 7;

		$message = TextFormat::YELLOW . "=-=-= " . TextFormat::LIGHT_PURPLE . "Gangs help (page {$page})" . TextFormat::YELLOW . " =-=-=" . TextFormat::RESET;
		$i = 0;
		$listed = [];
		foreach($this->getOwner()->getArguments() as $argument) {
			if($i >= $highest) break;
			if($i >= $lowest) {
				if(!in_array($argument->getName(), $listed)) {
					$message .= "\n" . TextFormat::GREEN . "{$argument->getName()}: " . TextFormat::WHITE . $argument->getDescription() . TextFormat::RESET;
					$listed[] = $argument->getName();
					$i++;
				}
			}
		}
		$sender->sendMessage($message);
	}

}