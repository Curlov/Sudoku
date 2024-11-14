<?php
class FilterData
{
    /**
     * @var array
     */
    private array $data;
    /**
     * @var array
     */
    private array $array = [];
    /**
     * @var array
     */
    private array $views = [];
    /**
     * @param array $data
     */
    public function __construct(array $data) {
        $this->data = $data;
        $this->array = [];
        $this->views = [];

        // Informationen die wir per GET oder POST bekommen haben und die unter den folgenden Keys liegen,
        // werden verarbeitet und "views" oder "array" zugewiesen. Views beinhaltet die Steuerungselemente
        // wie "action", "area" und "view", der Rest der Daten kommt ins "array".
        $fields = ['view', 'area', 'action', 'username', 'id', 'country', 'password', 'submit', 'range', 'solutions', 'note', 'field', 'number'];

        foreach ($fields as $field) {
            if ($field === 'id') {
                // Falls "id" nicht existiert, speichern wir id mit 0.
                $this->array[$field] = $data[$field] ?? 0;
            } elseif ($field === 'view') {
                // Falls keine "view" übergeben ist, wird "view" auf "login" gesetzt, wenn ein "username" in der SESSION gespeichert ist,
                // ansonsten wird "view" auf "main" gesetzt.
                $this->views[$field] = $data[$field] ?? (isset($_SESSION['username']) ? 'login' : 'main');
            } elseif ($field === 'area') {
                // Falls "area" nicht übergeben wurde, wird "area" auf "main" gesetzt.
                $this->views[$field] = $data[$field] ?? 'main';
            } elseif ($field === 'action') {
                // Falls "action" nicht übergeben wurde, wird "action" auf "showMain" gesetzt.
                $this->views[$field] = $data[$field] ?? 'showMain';
            } else {
                // Für alles andere gilt, wenn der Datensatz nicht leer ist, wird er an "array" übergeben
                if (!empty($this->data[$field])) {
                    $this->array[$field] = $data[$field];
                }
            }
        }
    }
    /**
     * @return array
     */
    public function getArray(): array {
        return $this->array;
    }
    /**
     * @return array
     */
    public function getViews(): array
    {
        return $this->views;
    }

}