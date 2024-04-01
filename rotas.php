<?php 

use Pecee\SimpleRouter\SimpleRouter;
use sistema\nucleo\Helpers;

try {
    // analisar onde precisar ser get e post
    SimpleRouter::setDefaultNamespace('sistema\Controlador');
    SimpleRouter::get(BASE_ROUTE,'SiteControlador@index');
    SimpleRouter::get(BASE_ROUTE.'404','SiteControlador@erro404');
    SimpleRouter::get(BASE_ROUTE.'sobre','SiteControlador@sobre');
    SimpleRouter::get(BASE_ROUTE.'post/{dado}','SiteControlador@post');
    SimpleRouter::get(BASE_ROUTE.'dashboard','SiteControlador@dashboard');
    SimpleRouter::match(['get','post'],BASE_ROUTE.'cadastro','SiteControlador@cadastroMaq');
    SimpleRouter::match(['get','post'],BASE_ROUTE.'layout','SiteControlador@cadastroLayout');
    SimpleRouter::match(['get','post'],BASE_ROUTE.'producao','SiteControlador@producao');
    SimpleRouter::start();

} catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $e) {
    
    if (Helpers::localhost()) {
        echo $e;
    } else {
        Helpers::redirecionar('404');
    }
    
}