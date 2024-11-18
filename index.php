<?php
try {
    // Der einzige Aufruf von SESSIONS
    session_start();

    // Config.php mit diversen Konstanten und den Zugangsdaten für die Datenbank wird geladen
    include 'config.php';

    // Auto-Loader zum Laden der Klassen. Anhand des Namenszusatzes wird ein entsprechender Ordner gewählt
    spl_autoload_register(function ($className): void {
        if (str_ends_with($className, 'Controller')){
            include './controllers/' . $className . '.php';
        } else {
            include './classes/' . $className . '.php';
        }});

    // Die REQUEST wird gespeichert
    $request = $_SERVER['REQUEST_METHOD'] ==='POST' ? $_POST : $_GET;

    // Die REQUEST wird in der Klasse FilterData aufbereitet
    $dataBlock = new FilterData($request);

    // Mit den Methoden getArray und getViews der Klasse FilterData werden die aufbereiteten Daten
    // den entsprechenden Arrays zugeteilt. Action, area und view werden unter $views zusammengefasst.
    $data = $dataBlock->getArray();
    $views = $dataBlock->getViews();

    // Abfrage nach der "action" und ob sie zulässig ist
    if ($views['action'] == 'showMain' || $views['action'] == 'showCreateBoard' || $views['action'] == 'showCreateCheck' ||
        $views['action'] == 'showCreateMask' || $views['action'] == 'showCreate' || $views['action'] == 'showCreateSafe' ||
        $views['action'] == 'showAuthentication' || $views['action'] == 'showPlayLevelSelection' ||
        $views['action'] == 'showPlay') {

        // Hier wird der Controller und die Methode invoke gemäß der "action" aufgerufen,
        // Invoke dient der jeweiligen Steuerung und gibt ein Array zurück.
        $controllerName = ucfirst($views['action']) . 'Controller';
        $controller = new $controllerName($views['area'], $views['view']);
        $array = $controller->invoke($data);

        // Das Array von invoke enthält den Namen des Arrays und das Array selbst. Hier wird der Name dem Array zugeteilt
        !empty($array) && ${$array['arrayName']} = $array['data'];

        // Der entsprechende View wird gemäß "area" und "view" geladen
        include './views/' . lcfirst($controller->getArea()) . '/' . lcfirst($controller->getView()) . '.php';
    }

// Hier fangen wir mögliche Fehler auf. Diese werden dann gegebenenfalls in die Log-Datei geschrieben und error.php wird ausgegeben
} catch (Exception $e) {
        file_put_contents(LOG_PATH, (new DateTime())->format('d.m.Y - H:i:s ').
            "  ".$e->getMessage() . "\n" . file_get_contents(LOG_PATH));

        include "./views/main/error.php";
}