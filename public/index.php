<?php

require_once __DIR__.'/../vendor/autoload.php';

use app\core\Application;
use app\controller\AppController;


$app = new Application();

$app->router->get('/',  [AppController::class, 'page']);
$app->router->post('/data', [AppController::class, 'action']);

$app->run();
