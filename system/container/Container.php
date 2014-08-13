<?php namespace system\container;
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

use ArrayAccess;

class Container implements ArrayAccess
{
	/**
	 * The container's shared instances.
	 *
	 * @var array
	 */
	protected $instances = array();

	protected static $self = null;

	public static function singleton()
	{
		if( is_null(self::$self))
		{
			self::$self = new static;
		}

		return self::$self;
	}

	/**
	 * Register an existing instance as shared in the container.
	 *
	 * @param  string  $alias
	 * @param  mixed   $instance
	 * @return void
	 */
	public function instance($alias, $instance)
	{
		if (!isset($this->instances[$alias]))
		{
			if(!is_object($instance))
			{
				$instance = new $instance;
			}

			$this->instances[$alias] = $instance;
		}
	}

	/**
	 * Determine if a given offset exists.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	public function offsetExists($key)
	{
		return isset($this->instances[$key]);
	}

	/**
	 * Get the value at a given offset.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function offsetGet($key)
	{
		if (!array_key_exists($key, $this->instances))
		{
			throw new InvalidArgumentException(sprintf('Identifier "%s" is not defined.', $key));
		}

		return $this->instances[$key];
	}

	/**
	 * Set the value at a given offset.
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return void
	 */
	public function offsetSet($key, $value)
	{
		if (!isset($this->instances[$key]))
		{
			if(!is_object($value))
			{
				$instance = new $value;
			}

			$this->instances[$key] = $instance;
		}
	}

	/**
	 * Unset the value at a given offset.
	 *
	 * @param  string  $key
	 * @return void
	 */
	public function offsetUnset($key)
	{
		unset($this->instances[$key]);
	}
}
