<?php

/**
 * Gangs – FormattableArgument.php
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
 * Created on 30/01/2017 at 8:48 PM
 *
 */

namespace conflict\gangs\command\formattable;

abstract class FormattableArgument implements Formattable {

	/** @var string */
	private $formatId = Formattable::FORMAT_STRING;

	/** @var string */
	protected $name;

	/** @var bool */
	protected $optional;

	public function __construct(string $format, string $name = "", $optional = false) {
		$this->formatId = $format;
		$this->name = $name;
		$this->optional = $optional;
	}

	public final function getFormat() : string {
		return $this->formatId;
	}

	public final function getName() : string {
		return $this->name;
	}

	public final function isOptional() : bool {
		return $this->optional;
	}

	public function setOption(bool$value = true) {
		$this->optional = $value;
	}

	/**
	 * Get the formatted arguments data and prepare it for the client
	 *
	 * @return array
	 */
	public function parse() : array {
		return [
			"name" => $this->name,
			"type" => $this->formatId,
		];
	}

}