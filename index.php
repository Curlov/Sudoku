<?php
session_start();

include 'config.php';

spl_autoload_register(function ($className): void {
    if (str_ends_with($className, 'Controller')){
        include 'controllers/' . $className . '.php';
    } else {
        include 'classes/' . $className . '.php';
    }});

$request = $_SERVER['REQUEST_METHOD'] ==='POST' ? $_POST : $_GET;
$dataBlock = new FilterData($request);
$data = $dataBlock->getArray();
$views = $dataBlock->getViews();

if ($views['action'] == 'showMain' || $views['action'] == 'showInsert' || $views['action'] == 'showAuthentication') {
    $controllerName = ucfirst($views['action']) . 'Controller';
    $controller = new $controllerName($views['area'], $views['view']);
    $array = $controller->invoke($data);
    !empty($array) && ${$array['arrayName']} = $array['data'];

    include 'views/' . $controller->getArea() . '/'.$controller->getView().'.php';
}