<?php namespace system\routing;
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

use \system\http\Request;
use \system\http\Response;

class Router
{
	protected $controller = 'HomeController';
	protected $method = 'indexAction';
	protected $params = [];

	/**
	 * Dispatch the request to the application.
	 */
	public function dispatch(Request $request)
	{
		$req = $request;

		$url = $this->parseUrl();

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

		$content = $this->controller->callAction($this->method, $this->params);

		$response = new Response();
		$response->setContent($content);

		return $response;
	}

	private function parseUrl()
	{
		if(isset($_GET['url']))
		{
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}

	public function testFacade()
	{
		return 1;
	}
} 