<?php
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */
use Illuminate\Filesystem\Filesystem;

class Application extends Container
{
	/**
	 * All of the registered service providers.
	 *
	 * @var array
	 */
	protected $serviceProviders = array();

	/**
	 * The names of the loaded service providers.
	 *
	 * @var array
	 */
	protected $loadedProviders = array();

	public function __construct()
	{
		// Register Request Object
		$this->instance('request', 'Request');
	}

	// Step 1: Load config, service provider
	public function getConfig()
	{
		$config = new Filesystem();

		$file = APP_DIR . "config/app.php";

		if ($config->exists($file))
		{
			$items = $config->getRequire($file);
		}

		return $items;
	}

	/**
	 * Get the service provider repository instance.
	 *
	 * @return ProviderRepository
	 */
	public function getProviderRepository()
	{
		return new ProviderRepository(new Filesystem);
	}

	/**
	 * Register a service provider with the application.
	 *
	 * @param  ServiceProvider|string  $provider
	 * @param  array  $options
	 * @param  bool   $force
	 * @return ServiceProvider
	 */
	public function register($provider)
	{
		$name = is_string($provider) ? $provider : get_class($provider);
		if (array_key_exists($name, $this->loadedProviders))
		{
			return array_first($this->serviceProviders, function($key, $value) use ($name)
			{
				return get_class($value) == $name;
			});
		}

		if (is_string($provider))
		{
			$provider = new $provider($this);
		}

		$provider->register();

		$this->serviceProviders[] = $provider;
		$this->loadedProviders[get_class($provider)] = true;

		return $provider;
	}

	// Step 2: Dispatch and render
	public function run()
	{
		// Dispatch request to controller
		$response = $this['router']->dispatch($this['request']);

		// Send data to client
		$response->send();

		// Terminal all object
	}
} 