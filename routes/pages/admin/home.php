<?php

# ROUTER_DEFAULT é rota padrão para o painel administrativo
# sempre que quiser criar uma rota para o painel admin user essa constante

$app->get("/". ROUTER_DEFAULT, App\Controller\admin\Home::class . ":getHomeAdmin");

# 1 colocando namespace::class . ":namemetodo"
$app->get("/". ROUTER_DEFAULT, App\Controller\admin\Home::class . ":getHomeAdmin");

