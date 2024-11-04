<?php

abstract class BaseController
{
    protected string $area;

    protected string $view;

    public function __construct(string $area)
    {
        $this->area = $area;
    }

    public function getArea(): string
    {
        return $this->area;
    }

    public function getView(): string
    {
        return $this->view;
    }

}