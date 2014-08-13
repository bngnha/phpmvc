<?php namespace system\routing;
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

class Route
{
	/**
	 * The URI pattern the route responds to.
	 *
	 * @var string
	 */
	protected $uri;

	/**
	 * The HTTP methods the route responds to.
	 *
	 * @var array
	 */
	protected $methods;

	/**
	 * The route action array.
	 *
	 * @var array
	 */
	protected $action;

	/**
	 * The default values for the route.
	 *
	 * @var array
	 */
	protected $defaults = array();

	public function __construct($methods, $uri, $action)
	{
		$this->uri = $uri;
		$this->methods = (array) $methods;
		$this->action = $action;
	}
} 