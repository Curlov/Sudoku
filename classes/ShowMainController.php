<?php

class ShowMainController
{
    private string $area;
    private string $view;
    /**
     * @param string $area
     * @param string $view
     */
    public function __construct(string $area,string $view) {
        $this->area = $area;
        $this->view = $view;
    }
    /**
     * @param array $delivery
     * @return array
     */
    public function invoke(array $delivery = []) : array
    {
        if ($this->area == 'main' && $delivery['id'] == 0) {
            return ['arrayName' => 'main', 'data' =>[]];
        } elseif ($this->area == 'car' && $delivery['id'] != 0) {
            return ['arrayName' => 'car', 'data' =>[]];
        }
        return [];
    }
    /**
     * @return string
     */
    public function getView(): string
    {
        return $this->view;
    }
    /**
     * @return string
     */
    public function getArea(): string
    {
        return $this->area;
    }
}