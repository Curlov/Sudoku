<?php
class ShowEnterController
{
    private string $area;
    private string $view;
    /**
     * @param string $area
     * @param string $view
     */
    public function __construct(string $area, string $view)
    {
        $this->area = $area;
        $this->view = $view;
    }
    /**
     * @param array $delivery
     * @return array
     */
    public function invoke(array $delivery = []){
        if ($this->area == 'main' && !empty($delivery['username'])) {
            if (!(new User())->isObjectRegistered($delivery['username'])) {
                $passwordHash = (new User())->getPasswordHash($delivery['password']);
                (new User)->enterObject($delivery['username'], $delivery['country'], $passwordHash);
                return ['arrayName' => 'user', 'data' => [(new User)->getObjectByName($delivery['username'])]];
            }
        }  elseif ($this->area == 'main' && empty($delivery['startDate'])) {
            return ['arrayName' => 'rentals', 'data' => []];
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