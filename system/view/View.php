<?php
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

class View
{
	/**
	 * @var string
	 */
	private $view;

	/**
	 * @var string
	 */
	private $layout;

	/**
	 * @var string|array()
	 */
	private $data;

	/**
	 * @var string
	 */
	private $path;

	/**
	 * @var string
	 */
	private $ext = '.php';

	/**
	 * @var string
	 */
	private $output;

	public function __construct()
	{
		$this->path = APP_DIR . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;
	}

	public function setView($view)
	{
		$this->view = $view;
	}

	public function setLayout($layout)
	{
		$this->layout = $layout;
	}

	public function assign($data)
	{
		if(is_object($data))
		{
			$this->data = compact($data);
		}
		else if(!is_array($data))
		{
			$data = array($data);

			array_merge_recursive($this->data, $data);
		}
	}

	public function render()
	{
		extract($this->data);

		ob_start();

		require($this->path . $this->view . $this->ext);

		$this->output = ob_get_contents();

		ob_end_clean();

		return $this->output;
	}
} 