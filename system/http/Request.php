<?php
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

class Request
{
	/**
	 * @var POST
	 *
	 * @api
	 */
	public $request;

	/**
	 * @var GET
	 *
	 * @api
	 */
	public $query;

	/**
	 * @var service
	 *
	 * @api
	 */
	public $server;

	/**
	 * @var file
	 *
	 * @api
	 */
	public $files;

	/**
	 * @var cookie
	 *
	 * @api
	 */
	public $cookies;

	/**
	 * @var array
	 *
	 * @api
	 */
	public $headers;

	/**
	 * @var array
	 */
	protected $languages;

	/**
	 * @var array
	 */
	protected $charsets;

	/**
	 * @var array
	 */
	protected $encodings;

	/**
	 * @var array
	 */
	protected $acceptableContentTypes;

	/**
	 * @var string
	 */
	protected $pathInfo;

	/**
	 * @var string
	 */
	protected $requestUri;

	/**
	 * @var string
	 */
	protected $baseUrl;

	/**
	 * @var string
	 */
	protected $basePath;

	/**
	 * @var string
	 */
	protected $method;

	/**
	 * @var string
	 */
	protected $format;

	/**
	 * @var Session interface
	 */
	protected $session;

	/**
	 * @var string
	 */
	protected $locale;

	/**
	 * @var string
	 */
	protected $defaultLocale = 'en';

	/**
	 * @var $self Request Static Object
	 */
	protected static $self;

	/**
	 * Construct
	 */
	public function __construct(array $query = array(),
								array $request = array(),
								array $attributes = array(),
								array $cookies = array(),
								array $files = array(),
								array $server = array(),
								$content = null)
	{
		$this->query = $query;
		$this->request = $request;
		$this->headers = $this->headers();
		$this->cookies = $cookies;
		$this->files = $files;
		$this->server = $server;
		$this->languages = null;
		$this->charsets = null;
		$this->encodings = null;
		$this->acceptableContentTypes = null;
		$this->pathInfo = null;
		$this->requestUri = null;
		$this->baseUrl = null;
		$this->basePath = null;
		$this->method = null;
		$this->format = null;
	}

	public function createFromGlobals()
	{
		if (self::$self)
		{
			$request = call_user_func($_GET, $_POST, array(), $_COOKIE, $_FILES, $_SERVER);

			if (!$request instanceof Request)
			{
				throw new \LogicException('The Request factory must return an instance of Request.');
			}

			return $request;
		}

		return new static($_GET, $_POST, array(), $_COOKIE, $_FILES, $_SERVER);
	}

	public function headers()
	{
		if (function_exists('apache_request_headers'))
		{
			$headers = apache_request_headers();
		}
		else
		{
			$headers['Content-Type'] = (isset($_SERVER['CONTENT_TYPE'])) ? $_SERVER['CONTENT_TYPE'] : @getenv('CONTENT_TYPE');

			foreach ($_SERVER as $key => $val)
			{
				if (strncmp($key, 'HTTP_', 5) === 0)
				{
					$headers[substr($key, 5)] = $_SERVER[$key];
				}
			}
		}

		foreach ($headers as $key => $val)
		{
			$key = str_replace('_', ' ', strtolower($key));
			$key = str_replace(' ', '-', ucwords($key));

			$this->headers[$key] = $val;
		}

		return $this->headers;
	}

	/**
	 * get
	 */
	public function get($key)
	{
		if ($key === NULL AND ! empty($_GET))
		{
			return (array)($_GET);
		}
		else
		{
			return $_GET[$key];
		}
	}

	public function post($key)
	{
		if ($key === NULL AND ! empty($_POST))
		{
			return (array)($_POST);
		}
		else
		{
			return $_POST[$key];
		}
	}
}
