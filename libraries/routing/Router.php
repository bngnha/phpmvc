<?php
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

class Router
{
	/**
	 * Dispatch the request to the application.
	 */
	public function dispatch(Request $request)
	{
		$this->currentRequest = $request;

		$response = $this->dispatchToRoute($request);

		$response = $this->prepareResponse($request, $response);

		return $response;
	}

	public function parseUrl()
	{
		if(isset($_GET['url']))
		{
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
} 