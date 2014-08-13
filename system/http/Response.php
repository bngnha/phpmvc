<?php namespace system\http;
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

class Response
{
	/**
	 * @var $data: Data output
	 */
	protected $data;

	/**
	 * @var array $header: Header information need to output
	 */
	protected $headers = array();

	public function __construct()
	{
		// Check compress

		// Set default content type
		$header = 'Content-Type: text/html';
		$this->headers[] = array($header, TRUE);
	}

	public function setHeader($header, $replace)
	{

	}

	/**
	 * Set content for response object before send to client
	 * @param $data
	 */
	public function setContent($data)
	{

		$this->data = $data;
	}

	/**
	 * Send content to client
	 */
	public function send()
	{
		// Send header
		$this->_prepareHeader();

		// Send content
		echo $this->data;
	}

	private function _prepareHeader()
	{
		// Are there any server headers to send?
		if (count($this->headers) > 0)
		{
			foreach ($this->headers as $header)
			{
				@header($header[0], $header[1]);
			}
		}
	}
} 