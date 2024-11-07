<?php

class ShowCreateSafeController extends BaseController
{
    public function __construct(string $area,string $view)
    {
        parent::__construct($area);
        $this->view = $view;
    }

    /**
     * @param array $delivery
     * @return array
     * @throws Exception
     */
    public function invoke(array $delivery = []): array
    {
        $jsonBoard = json_encode($_SESSION['board']);
        $jsonMask = json_encode($_SESSION['mask']);

        (new Board())->enterObject($jsonBoard, $jsonMask, $_SESSION['range'] );

        unset($_SESSION['sudoku']);
        unset($_SESSION['board']);
        unset($_SESSION['mask']);
        unset($_SESSION['range']);
        unset($_SESSION['solutions']);

        return ['arrayName' => 'nothing', 'data' => []];
    }
}