<?php

/**
 * Gangs – FormattableCommandArgument.php
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
 * Created on 05/02/2017 at 6:09 PM
 *
 */

namespace conflict\gangs\command\formattable\argument;

use pocketmine\command\CommandSender;

interface FormattableCommandArgument {

	public function getName() : string;

	public function getList() : CommandArgumentList;

	public function getAliases() : array;

	public function registerAlias(string $alias) : bool;

	public function execute(CommandSender $sender);

}