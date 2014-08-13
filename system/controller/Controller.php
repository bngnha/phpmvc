<?php namespace system\controller;
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

use \system\application\Application;

class Controller
{
	/**
	 * @var object Application
	 */
	protected $app;

	/**
	 * The layout used by the controller.
	 *
	 */
	protected $layout;

	/**
	 * @var object: View object
	 */
	protected $view;

	public function __construct()
	{
		$this->view = Application::singleton()['view'];
	}

	/**
	 * Create the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setLayout() {}

	public function assign($data)
	{
		$this->view->assign($data);
	}

	public function view($view = '')
	{
		$this->view->setView($view);
	}

	/**
	 * Execute an action on the controller.
	 *
	 * @param string  $method
	 * @param array   $parameters
	 */
	public function callAction($method, $parameters)
	{
		$this->view->setLayout($this->layout);

		call_user_func_array(array($this, $method), $parameters);

		$content = $this->view->render();

		return $content;
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