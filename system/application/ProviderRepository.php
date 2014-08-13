<?php namespace system\application;
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

use Illuminate\Filesystem\Filesystem;

class ProviderRepository
{
	/**
	 * The filesystem instance.
	 *
	 * @var Filesystem
	 */
	protected $files;

	public function __construct(Filesystem $files)
	{
		$this->files = $files;
	}

	public function load(Application $app, array $providers)
	{
		foreach ($providers as $provider)
		{
			$app->register($this->createProvider($app, $provider));
		}
	}

	/**
	 * Create a new provider instance.
	 *
	 * @param  $app
	 * @param  string  $provider
	 * @return ServiceProvider
	 */
	public function createProvider(Application $app, $provider)
	{
		return new $provider($app);
	}
} 