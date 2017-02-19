<?php

/**
 * Gangs – CommandArgument.php
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
 * Created on 05/02/2017 at 6:17 PM
 *
 */

namespace conflict\gangs\command\formattable\argument;

use conflict\gangs\command\GangsCommand;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

abstract class CommandArgument implements FormattableCommandArgument {

	/** @var GangsCommand */
	private $owner = null;

	/** @var string */
	private $name;

	/** @var CommandArgumentList */
	private $list;

	/** @var string */
	private $usage;

	/** @var array */
	private $aliases;

	public function __construct(GangsCommand $owner, string $name, CommandArgumentList $list, string $usage = "", array $aliases = []) {
		$this->owner = $owner;
		$this->name = $name;
		$this->list = $list;
		$this->usage = $usage;
		$this->aliases = $aliases;
	}

	public function getOwner() : GangsCommand {
		return $this->owner;
	}

	public function getName() : string {
		return $this->name;
	}

	public function getList() : CommandArgumentList {
		return $this->list;
	}

	public function getUsage() : string {
		return $this->usage;
	}

	public function getAliases() : array {
		return $this->aliases;
	}

	public function sendUsage(CommandSender $sender) {
		$sender->sendMessage(TextFormat::RED . "Usage: " . TextFormat::GOLD . $this->usage);
	}

	public function registerAlias(string $alias) : bool {
		if(!in_array($alias = strtolower($alias), $this->aliases)) {
			$this->aliases[] = $alias;
			return true;
		}
		return false;
	}

	/**
	 * Actions to preform on execution
	 *
	 * @param CommandSender $sender
	 * @param array $args
	 *
	 * @return mixed
	 */
	public abstract function execute(CommandSender $sender, array $args = []);

}