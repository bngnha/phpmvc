<?php
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */
require BASE_DIR . '/vendor/autoload.php';

require BASE_DIR . '/system/application/Application.php';

$app = Application::singleton();

$providers = $app->getConfig()['providers'];

// Load service prodiver
$app->getProviderRepository()->load($app, $providers);

return $app;
