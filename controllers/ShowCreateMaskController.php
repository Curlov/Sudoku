<?php
// Der Controller lässt anhand der übergebenen Schwierigkeitsstufe (range) eine Maske erzeugen und
// speichert Maske und die Schwierigkeitsstufe (range) in der dazugehörigen SESSION.
// Das Array, welches wir zurückgeben ist leer.
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
        $_SESSION['range'] = $delivery['range'];

        return ['arrayName' => 'nothing', 'data' => []];
    }
}