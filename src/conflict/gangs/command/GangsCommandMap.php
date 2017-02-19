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

namespace conflict\gangs\command;

use conflict\gangs\command\defaults\GangCommand;
use conflict\gangs\command\GangsCommand;
use conflict\gangs\Gangs;
use pocketmine\scheduler\FileWriteTask;

class GangsCommandMap {

	/** @var GangsCommand[] */
	protected $commands = [];

	/** @var $plugin */
	private $plugin;

	/** @var bool */
	private $useCache = true;

	/** @var array */
	private $cache = null;

	/**
	 * CommandMap constructor
	 *
	 * @param Gangs $plugin
	 */
	public function __construct(Gangs $plugin) {
		$this->plugin = $plugin;
		$this->useCache = $plugin->getSettings()->getNested("settings.cache-command-data", true);
		$this->cache = $this->useCache() ? $this->loadCache() : new \stdClass();
	}

	/**
	 * Set the default commands
	 */
	public function setDefaultCommands() {
		$this->registerAll([
			new GangCommand($this->plugin)
		]);
		$this->saveCache(true);
	}

	public function getPlugin() : Gangs {
		return $this->plugin;
	}

	public function useCache() : bool {
		return $this->useCache;
	}

	private function loadCache() {
		if(!is_file($this->plugin->getDataFolder() . "command_cache.json")) {
			touch($this->plugin->getDataFolder() . "command_cache.json");
			return new \stdClass();
		}
		return json_decode($this->plugin->getDataFolder() . "command_cache.json");
	}

	public function cache(GangsCommand $command, \stdClass $data) {
		$this->cache->{strtolower($command->getName())} = $data;
	}

	/**
	 * @param GangsCommand $command
	 *
	 * @return null
	 */
	public function getFromCache(GangsCommand $command) {
		$key = strtolower($command->getName());
		if(isset($this->cache->{$key})) {
			return $this->cache->{$key};
		}
		return null;
	}

	public function saveCache($async = true) {
		$data = json_encode($this->cache);
		$path = $this->getPlugin()->getDataFolder() . "command_cache.json";
		if($async) {
			$this->plugin->getServer()->getScheduler()->scheduleAsyncTask(new FileWriteTask($path, $data));
		} else {
			file_put_contents($path, $data);
		}
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
			$this->saveCache(false);
			$this->unregister($command);
		}
		unset($this->commands, $this->plugin);
	}

}