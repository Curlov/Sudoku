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
        if ($this->area == 'create' && $this->view == 'create') {
            $newBoard = new Board();
            $newBoard->backtracking();
            return ['arrayName' => 'board', 'data' => $newBoard->getBoard()];
        }
    }

}