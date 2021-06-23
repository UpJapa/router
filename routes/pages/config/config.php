<?php

use App\Core\Http\Router;
$app = new Router();

/**
 * ROTA DE CONFIGURAÇÃO AO BANCO DE DADOS
 */
$app->get("/".md5("dbconfig")."", App\Controller\frontend\Config::class . ":getDbConfig");

/**
 * ROTA RESPONSÁVEL POR CRIAR BANCO DE DADOS
 */
$app->post("/".md5("dbconfig")."", App\Controller\frontend\Config::class . ":setDbConfig");

/**
 * ROTA RESPOSAVEL POR CRIAR O USUARIO ADMINISTRATIVO
 */
$app->get("/".md5("adminconfig")."", App\Controller\frontend\Config::class . ":getAdminConfig");

/**
 * ROTA RESPONSÁVEL POR CRIAR USUARIO ADMINISTRATIVO
 */
$app->post("/".md5("adminconfig")."", App\Controller\frontend\Config::class . ":setAdminConfig");

/**
 * ROTA RESPOSAVEL POR CRIAR O USUARIO ADMINISTRATIVO
 */
$app->get("/".md5("success")."", App\Controller\frontend\Config::class . ":success");