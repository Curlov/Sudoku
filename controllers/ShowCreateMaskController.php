<?php

class ShowCreateMaskController extends BaseController
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
        $newMask = new Board();
        $newMask->createMask($delivery['range']);
        $_SESSION['mask'] = $newMask->getMask();

        return ['arrayName' => 'mask', 'data' => $_SESSION['mask']];
    }

}