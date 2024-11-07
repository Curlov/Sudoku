<?php
class ShowPlayController extends BaseController
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
        echo "<pre><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        print_r($delivery);
        echo "</pre>";

        if(isset($delivery['note']) && $delivery['note'] == 1){
            $_SESSION['note'] = 1;
        } else {
            $_SESSION['note'] = 0;
        }

        $mask = $_SESSION['mask'];
        $board = $_SESSION['board'];
        $faulty = $_SESSION['faulty'];
        $sudoku = $_SESSION['sudoku'];

        return ['arrayName' => 'nothing', 'data' => $delivery];
    }

}