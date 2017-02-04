<?php

/**
 * Gangs – GangsCommand.php
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
 * Created on 29/01/2017 at 5:07 PM
 *
 */

namespace conflict\gangs\command;

use conflict\gangs\Gangs;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;

abstract class GangsCommand extends Command implements PluginIdentifiableCommand {

	/** @var Gangs */
	private $plugin = null;

	public function __construct(Gangs $plugin, $name, $description = "", $usageMessage = null, $aliases = []) {
		$this->plugin = $plugin;
		parent::__construct($name, $description, $usageMessage, $aliases);
	}

	public function getPlugin() : Gangs {
		return $this->plugin;
	}

	/**
	 * Handle the initial command call
	 *
	 * @param CommandSender $sender
	 * @param string $commandLabel
	 * @param array $args
	 *
	 * @return bool
	 */
	public final function execute(CommandSender $sender, $commandLabel, array $args) : bool {
		if($this->testPermission($sender) and $this->checkSender($sender)) {
			return $this->onCommand($sender, $args);
		}
		return false;
	}

	/**
	 * Check to make sure the sender is valid
	 *
	 * @param CommandSender $sender
	 *
	 * @return bool
	 */
	protected abstract function checkSender(CommandSender $sender) : bool;

	/**
	 * Handle command execution
	 *
	 * @param CommandSender $sender
	 * @param array $args
	 *
	 * @return bool
	 */
	protected abstract function onCommand(CommandSender $sender, array $args) : bool;

}