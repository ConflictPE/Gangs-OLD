<?php

/**
 * Gangs – GangsCommandMap.php
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
 * Created on 05/02/2017 at 7:12 PM
 *
 */

namespace conflict\gangs\command\formattable;

use conflict\gangs\command\defaults\GangCommand;
use conflict\gangs\command\GangsCommand;
use conflict\gangs\Gangs;

class GangsCommandMap {

	/** @var GangsCommand[] */
	protected $commands = [];

	/** @var $plugin */
	private $plugin;

	/**
	 * CommandMap constructor
	 *
	 * @param Gangs $plugin
	 */
	public function __construct(Gangs $plugin) {
		$this->plugin = $plugin;
		$this->setDefaultCommands();
	}

	/**
	 * Set the default commands
	 */
	public function setDefaultCommands() {
		$this->registerAll([
			new GangCommand($this->plugin)
		]);
	}

	/**
	 * @return Gangs
	 */
	public function getPlugin() {
		return $this->plugin;
	}

	/**
	 * Register an array of commands
	 *
	 * @param array $commands
	 */
	public function registerAll(array $commands) {
		foreach($commands as $command) {
			$this->register($command);
		}
	}

	/**
	 * Register a command
	 *
	 * @param GangsCommand $command
	 * @param string $fallbackPrefix
	 *
	 * @return bool
	 */
	public function register(GangsCommand $command, $fallbackPrefix = "cc") {
		$this->plugin->getServer()->getCommandMap()->register($fallbackPrefix, $command);
		$this->commands[strtolower($command->getName())] = $command;
		return true;
	}

	/**
	 * Unregisters all commands
	 */
	public function clearCommands() {
		foreach($this->commands as $command) {
			$this->unregister($command);
		}
		$this->commands = [];
		$this->setDefaultCommands();
	}

	/**
	 * Unregister a command
	 *
	 * @param GangsCommand $command
	 */
	public function unregister(GangsCommand $command) {
		//$this->plugin->getServer()->getCommandMap()->unregister($command);
		unset($this->commands[strtolower($command->getName())]);
	}

	/**
	 * Get a command
	 *
	 * @param $name
	 *
	 * @return GangsCommand|null
	 */
	public function getCommand($name) {
		if(isset($this->commands[$name])) {
			return $this->commands[$name];
		}
		return null;
	}

	/**
	 * @return GangsCommand[]
	 */
	public function getCommands() {
		return $this->commands;
	}

	public function __destruct() {
		$this->close();
	}

	public function close() {
		foreach($this->commands as $command) {
			$this->unregister($command);
		}
		unset($this->commands, $this->plugin);
	}

}