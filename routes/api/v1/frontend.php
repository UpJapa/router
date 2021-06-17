<?php

use App\Core\Http\Response;
use App\Core\Http\Router;

$app = new Router();

# 1 colocando namespace::class . ":namemetodo"
$app->get("/api/v1", App\Controller\Application::class . ":getData");

