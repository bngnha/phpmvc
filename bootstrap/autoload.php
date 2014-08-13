<?php
/**
 * @package		phpmvc
 * @author		NTKSoft Team
 * @copyright   Copyright (C) 2014 NTKSoft, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 */
require BASE_DIR . '/vendor/autoload.php';

$app = \system\application\Application::singleton();

// Set application to facade
\system\facade\Facade::setContainer($app);

$providers = $app->getConfig()['providers'];

\system\routing\Router::testFacade();

// Load service provider
$app->getProviderRepository()->load($app, $providers);

return $app;
