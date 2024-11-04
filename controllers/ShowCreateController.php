<?php

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
        if ($this->area == 'create' && $this->view == 'create') {
            $spiel = new Board();
            $spiel->backtracking();
            return ['arrayName' => 'create', 'data' => [$spiel->getBoard()]];
        }
    }

}