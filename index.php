<?php

include 'config.php';

spl_autoload_register(function ($className) {
    include 'classes/' . $className . '.php';
});

$request = $_SERVER['REQUEST_METHOD'] ==='POST' ? $_POST : $_GET;
$dataBlock = new FilterData($request);
$data = $dataBlock->getArray();
$views = $dataBlock->getViews();

print_r($views);

if ($views['action'] == 'showMain' || $views['action'] == 'showCreate' || $views['action'] == 'showPlay') {
    $controllerName = ucfirst($views['action']) . 'Controller';
    $controller = new $controllerName($views['area'], $views['view']);
    //$array = $controller->invoke($data);
    //!empty($array) && ${$array['arrayName']} = $array['data'];

    include 'views/' . $controller->getArea() . '/' . $controller->getView() . '.php';
}