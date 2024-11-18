<?php
// Der Level-Selection-Controller generiert ein neues Spiel anhand der ausgewählten Spielstärke
class ShowPlayLevelSelectionController extends BaseController
{
    public function __construct(string $area,string $view)
    {
        parent::__construct($area);
        $this->view = $view;
    }
    /**
     * @param array $delivery
     * @return array
     */
    public function invoke(array $delivery = []) : array
    {
        // Je nach gedrückten Button wird die Spielstärke gesetzt
        switch ($delivery['submit']) {
            case 'Light':
                $level = 4;
                break;
            case 'Medium':
                $level = 3;
                break;
            case 'Heavy':
                $level = 2;
                break;
        }
        //
        $game = new Board();
        // Läd ein gemäß der Spielstärke zufällig ausgewähltes Sudoku aus der Datenbank.
        $data = $game->getRandomObjectByLevel($level);
        // Decodiert den JSON-String des "Boardes" aus der Datenbank in ein Array zurück.
        $board = json_decode($data['board'], true);
        //WICHTIG, Board muss gesetzt werden, bevor die Methode createSudoku aufgerufen wird!
        $game->setBoard($board);
        // Decodiert den JSON-String der "Maske" aus der Datenbank in ein Array zurück.
        $mask = json_decode($data['mask'], true);

        // Alle benötigten SESSIONS werden gesetzt.
        $_SESSION['mask'] = $mask;
        $_SESSION['board'] = $board;
        $_SESSION['sudoku'] = $game->createSudoku($board, $mask);
        $_SESSION['startTime'] = time();
        $_SESSION['faults'] = 0;
        $_SESSION['field'] = 0;

        // Das mehrdimensionale Array für die Notizen wird angelegt
        $_SESSION['notes'] = [
            1 => [1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [], 8 => [], 9 => []],
            2 => [1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [], 8 => [], 9 => []],
            3 => [1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [], 8 => [], 9 => []],
            4 => [1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [], 8 => [], 9 => []],
            5 => [1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [], 8 => [], 9 => []],
            6 => [1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [], 8 => [], 9 => []],
            7 => [1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [], 8 => [], 9 => []],
            8 => [1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [], 8 => [], 9 => []],
            9 => [1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [], 8 => [], 9 => []]
        ];

        // "fault" wird auf "false" gesetzt, um den "Error-Sound" nicht auszulösen.
        return ['arrayName' => 'fault', 'data' => false];
    }

}