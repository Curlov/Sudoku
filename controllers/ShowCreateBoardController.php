<?php

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

        return ['arrayName' => 'board', 'data' => $_SESSION['board']];
    }

}