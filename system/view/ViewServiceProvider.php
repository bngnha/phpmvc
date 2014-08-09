<?php
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

class ViewServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->instance('view', new View());
	}
} 