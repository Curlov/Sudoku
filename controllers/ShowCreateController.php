<?php
// Der Controller erzeugt ein neues leeres "board" und gibt es per Array zurück.
class ShowCreateController extends BaseController
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
            $board = (new Board())->getBoard();
            return ['arrayName' => 'board', 'data' => $board];
    }

}