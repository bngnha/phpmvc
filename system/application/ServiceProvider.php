<?php namespace system\application;
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

abstract class ServiceProvider
{
	/**
	 * The application instance.
	 */
	protected $app;
	/**
	 * Create a new service provider instance.
	 *
	 * @param  $app
	 * @return void
	 */
	public function __construct($app)
	{
		$this->app = $app;
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	abstract public function register();

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}
} 