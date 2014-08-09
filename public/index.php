<?php
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */

$baseDir = dirname(dirname(__FILE__));
$appDir = $baseDir . DIRECTORY_SEPARATOR . 'app';

if (realpath($appDir) !== FALSE)
{
	$appDir = realpath($appDir).'/';
}

// ensure there's a trailing slash
$appDir = rtrim($appDir, '/').'/';

// Path to the system folder
define('APP_DIR', str_replace("\\", "/", $appDir));

$app = require __DIR__.'/../bootstrap/Autoload.php';

// Execute request
$app->run();
