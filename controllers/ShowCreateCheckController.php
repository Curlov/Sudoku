<?php

class ShowCreateCheckController extends BaseController
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
        $newBoard->setBoard($_SESSION['sudoku']);
        $newBoard->solutionsCount();
        $_SESSION['solutions'] = $newBoard->solutionCount;

        return ['arrayName' => 'solutionCount', 'data' => $newBoard->solutionCount];
    }

}