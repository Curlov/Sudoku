<?php
// Erzeugt ein neues Board mittels Backtracking-Methode und speichert es in der SESSION "board".
class ShowCreateBoardController extends BaseController
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
    public function invoke(array $delivery = []): array
    {
        $newBoard = new Board();
        $newBoard->backtracking();
        $_SESSION['board'] = $newBoard->getBoard();

        return ['arrayName' => 'nothing', 'data' => []];
    }

}