<?php
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */
require __DIR__. '/../vendor/autoload.php';

require __DIR__. '/../libraries/application/Application.php';

$app = new Application();

$providers = $app->getConfig()['providers'];

// Load service prodiver
$app->getProviderRepository()->load($app, $providers);

return $app;
