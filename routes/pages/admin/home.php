<?php



# 1 colocando namespace::class . ":namemetodo"
$app->get("/admin", App\Controller\admin\Home::class . ":getHomeAdmin");

