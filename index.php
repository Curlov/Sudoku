<?php
try {
    session_start();

    include 'config.php';

    spl_autoload_register(function ($className): void {
        if (str_ends_with($className, 'Controller')){
            include 'controllers/' . $className . '.php';
        } else {
            include 'classes/' . $className . '.php';
        }});

    $request = $_SERVER['REQUEST_METHOD'] ==='POST' ? $_POST : $_GET;

//    echo "<pre>";
//    print_r($request);
//    echo "</pre>";

    $dataBlock = new FilterData($request);
    $data = $dataBlock->getArray();
    $views = $dataBlock->getViews();

    if ($views['action'] == 'showMain' || $views['action'] == 'showCreateBoard' || $views['action'] == 'showCreateCheck' ||
        $views['action'] == 'showCreateMask' || $views['action'] == 'showCreate' || $views['action'] == 'showCreateSafe' ||
        $views['action'] == 'showAuthentication' || $views['action'] == 'showPlayLevelSelection') {

        $controllerName = ucfirst($views['action']) . 'Controller';
        $controller = new $controllerName($views['area'], $views['view']);
        $array = $controller->invoke($data);
        !empty($array) && ${$array['arrayName']} = $array['data'];

        include 'views/' . $controller->getArea() . '/' . $controller->getView() . '.php';
    }

} catch (Exception $e) {
        file_put_contents(LOG_PATH, (new DateTime())->format('d.m.Y - H:i:s ').
            "  ".$e->getMessage() . "\n" . file_get_contents(LOG_PATH));

        include "views/main/error.php";
}