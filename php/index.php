<?php declare(strict_types=1);

use Frontend\Factory;
use Frontend\Http\Request;

require_once __DIR__ . '/../vendor/autoload.php';

$factory = new Factory();
$factory->createErrorHandler()->register();

$app = $factory->createApplication();
$response = $app->handle(Request::fromSuperGlobals());
$response->send();
