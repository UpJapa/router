<?php

use App\Core\Http\Response;
use App\Core\Http\Router;


# 1 colocando namespace::class . ":namemetodo"
$app->get("/api/v1", App\Controller\api\v1\Application::class . ":getData");

