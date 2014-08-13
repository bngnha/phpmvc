<?php namespace system\routing;
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

use \system\application\ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->instance('router', new Router());
	}
} 