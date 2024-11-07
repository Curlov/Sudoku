<?php
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
        $Bc = new Board();
        $data = $Bc->getRandomObjectByLevel($level);
        $board = json_decode($data['board'], true);
        //Board muss gesetzt werden, bevor die Methode createSudoku aufgerufen wird
        $Bc->setBoard($board);
        $mask = json_decode($data['mask'], true);

        $_SESSION['mask'] = $mask;
        $_SESSION['board'] = $board;
        $_SESSION['faulty'] = 0;
        $_SESSION['sudoku'] = $Bc->createSudoku($board, $mask);

        return ['arrayName' => 'nothing', 'data' => []];
    }

}