<?php

// Run using php your-command.php your-command-name

require __DIR__ . '/../vendor/autoload.php';

use Application\Controller\LoginController;
use Symfony\Component\Console\Application;
use Zend\Stdlib\ArrayUtils;
use Zend\Mvc\Application as ZendApplication;

$appConfig = require __DIR__ . '/../config/application.config.php';
if (file_exists(__DIR__ . '/../config/development.config.php')) {
    $appConfig = ArrayUtils::merge(
        $appConfig,
        require __DIR__ . '/../config/development.config.php'
    );
}
$zendApplication = ZendApplication::init($appConfig);
$serviceManager = $zendApplication->getServiceManager();

(new Application('Name of your application'))
    ->register('your-command-name')
    ->setCode(
        function () use ($serviceManager) {

            /** @var LoginController $controller */
            $controller = $serviceManager->get('ControllerManager')->get(YourController::class);

            echo 'Running YourControler->commandToRun()' . PHP_EOL;
            $controller->commandToRun();
        }
    )
    ->getApplication()
    ->run();
