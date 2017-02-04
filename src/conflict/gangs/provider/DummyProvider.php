<?php

/**
 * Gangs – DummyProvider.php
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
 * Created on 29/01/2017 at 4:51 PM
 *
 */

namespace conflict\gangs\provider;

use conflict\gangs\Gangs;

/**
 * Gangs dummy provider
 */
abstract class DummyProvider implements BaseProviderInterface {

	private $plugin;

	public function __construct(Gangs $plugin) {
		$this->plugin = $plugin;
	}

	public function getPlugin() : Gangs {
		return $this->plugin;
	}

	protected abstract function init();

}