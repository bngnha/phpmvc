<?php namespace system\facade;
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

abstract class Facade
{
	/**
	 * @var Application: Main container of Application
	 */
	private static $app;

	public static function setContainer($app)
	{
		self::$app = $app;
	}

	public function getContainer()
	{
		return self::$app;
	}

	public function __callStatic($method, $arguments)
	{
		$instance = self::$app[self::getFacadeAssessor()];
		return call_user_func_array(array($instance, $method), $arguments);
	}

	abstract public static function getFacadeAssessor();
}
