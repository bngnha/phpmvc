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


	protected $controller = 'HomeController';
	protected $method = 'indexAction';
	protected $params = [];

	private $response;

	public function __construct()
	{
	}

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
	public function register($provider, $options = array())
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
		$url = $this['router']->parseUrl();

		if(file_exists('../app/controllers/'. $url[0] .'.php'))
		{
			$this->controller = $url[0];
			unset($url['0']);
		}

		require_once '../app/controllers/'. $this->controller .'.php';
		$this->controller = new $this->controller;

		if(isset($url[1]))
		{
			if(method_exists($this->controller, $url['1']))
			{
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = $url ? array_values($url) : [];
		$this->response = $this->controller->callAction($this->method, $this->params);
	}

	public function dispatch(Request $request)
	{
		return (new Router())->dispatch($request);
	}

	public function __toString()
	{
		return $this->response;
	}
} 