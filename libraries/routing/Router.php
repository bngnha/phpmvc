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

		// If no response was returned from the before filter, we will call the proper
		// route instance to get the response. If no route is found a response will
		// still get returned based on why no routes were found for this request.
		$response = $this->callFilter('before', $request);

		if (is_null($response))
		{
			$response = $this->dispatchToRoute($request);
		}

		$response = $this->prepareResponse($request, $response);

		// Once this route has run and the response has been prepared, we will run the
		// after filter to do any last work on the response or for this application
		// before we will return the response back to the consuming code for use.
		$this->callFilter('after', $request, $response);

		return $response;
	}
} 