<?php
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

class Controller
{
	/**
	 * The layout used by the controller.
	 *
	 */
	protected $layout;

	/**
	 * Create the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout() {}

	/**
	 * Execute an action on the controller.
	 *
	 * @param string  $method
	 * @param array   $parameters
	 */
	public function callAction($method, $parameters)
	{
		$this->setupLayout();

		$response = call_user_func_array(array($this, $method), $parameters);

		// If no response is returned from the controller action and a layout is being
		// used we will assume we want to just return the layout view as any nested
		// views were probably bound on this view during this controller actions.
		if (is_null($response) && ! is_null($this->layout))
		{
			$response = $this->layout;
		}

		return $response;
	}

	/**
	 * Handle calls to missing methods on the controller.
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return mixed
	 *
	 * @throws \BadMethodCallException
	 */
	public function __call($method, $parameters)
	{
		throw new \BadMethodCallException("Method [$method] does not exist.");
	}
} 