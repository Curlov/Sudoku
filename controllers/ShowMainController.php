<?php
// Ein leerer Controller, der aufgerufen wird, wenn wir den "view" main anzeigen.
class ShowMainController extends BaseController
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
        return [];
    }

}