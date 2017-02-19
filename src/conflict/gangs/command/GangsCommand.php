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

use conflict\gangs\command\formattable\argument\CommandArgument;
use conflict\gangs\Gangs;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

abstract class GangsCommand extends Command implements PluginIdentifiableCommand {

	/** @var Gangs */
	private $plugin = null;

	/** @var CommandArgument[] */
	private $arguments;

	public function __construct(Gangs $plugin, $name, $description = "", $usageMessage = null, $aliases = []) {
		$this->plugin = $plugin;
		parent::__construct($name, $description, $usageMessage, $aliases);
		$this->registerDefaultArguments();
	}

	public function getPlugin() : Gangs {
		return $this->plugin;
	}

	public function sendUsage(CommandSender $sender) {
		$sender->sendMessage(TextFormat::RED . "Usage: " . TextFormat::GOLD . $this->getUsage());
	}

	public function getDefaultArguments() : array {
		return [];
	}

	private function registerDefaultArguments() {
		foreach($this->getDefaultArguments() as $argument) {
			$this->registerArgument($argument);
		}
	}

	public function registerArgument(CommandArgument $argument) {
		if(!isset($this->arguments[$argument->getName()])) {
			$this->arguments[$argument->getName()] = $argument;
			foreach($argument->getAliases() as $alias) {
				if(!isset($this->arguments[$alias])) {
					$this->arguments[$alias] = $argument;
				} else {
					$this->plugin->getLogger()->notice("{$this->getName()} attempted to register an argument alias when one already exists! Command: {$this->getName()} Alias: '{$alias}'!");
				}
			}
		} else {
			$this->getPlugin()->getLogger()->notice("Attempted to register an argument that already exists! Command: {$this->getName()} Argument: {$argument->getName()}");
		}
	}

	/**
	 * @return CommandArgument[]
	 */
	public function getArguments() : array {
		return $this->arguments;
	}

	/**
	 * @param string $name
	 *
	 * @return CommandArgument|null
	 */
	public function getArgument($name) {
		return $this->arguments[$name] ?? null;
	}

	public function generateCustomCommandData(Player $player) {

		$customData = parent::generateCustomCommandData($player);
		$cached = $this->plugin->getCommandMap()->getFromCache($this);
		if($this->plugin->getCommandMap()->useCache() and $cached !== null) {
			$customData = $cached;
		} else {
			if(!isset($customData->overloads)) {
				$customData->overloads = new \stdClass();
			} else {
				unset($customData->overloads->default);
			}
			foreach($this->getArguments() as $argument) {
				$i = 0;
				$customData->overloads->{$argument->getName()} = new \stdClass();
				$customData->overloads->{$argument->getName()}->input = new \stdClass();
				$customData->overloads->{$argument->getName()}->input->parameters = [];
				$customData->overloads->{$argument->getName()}->input->parameters[$i] = new \stdClass();
				$customData->overloads->{$argument->getName()}->input->parameters[$i]->name = $argument->getName();
				$customData->overloads->{$argument->getName()}->input->parameters[$i]->type = "string";
				$customData->overloads->{$argument->getName()}->input->parameters[$i]->optional = false;
				foreach($argument->getList()->getList() as $format) {
					$i++;
					$customData->overloads->{$argument->getName()}->input->parameters[$i] = new \stdClass();
					$customData->overloads->{$argument->getName()}->input->parameters[$i]->name = $format->getName();
					$customData->overloads->{$argument->getName()}->input->parameters[$i]->type = $format->getFormat();
					$customData->overloads->{$argument->getName()}->input->parameters[$i]->optional = $format->isOptional();
				}
			}
			if($this->plugin->getCommandMap()->useCache()) {
				$this->plugin->getCommandMap()->cache($this, $customData);
			}
		}
		return $customData;
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