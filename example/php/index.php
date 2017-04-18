<?php declare(strict_types=1);

use Fury\Http\Request;

require_once __DIR__ . '/../../vendor/autoload.php';

$factory = new \Fury\Example\Factory();
$factory->createErrorHandler()->register();

$app = $factory->createApplication();
$response = $app->handle(Request::fromSuperGlobals());
$response->send();
