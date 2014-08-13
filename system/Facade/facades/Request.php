<?php namespace system\facade\facades;
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

use \system\facade\Facade;

class Request extends Facade
{
	public static function getFacadeAssessor() { return 'request'; }
} 