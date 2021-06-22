<?php

use App\Core\Http\Router;
$app = new Router();
$app->get("/config", App\Controller\frontend\Config::class . ":getDbConfig");
$app->post("/config", App\Controller\frontend\Config::class . ":setDbConfig");
