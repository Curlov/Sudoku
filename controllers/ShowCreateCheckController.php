<?php
// Der Controller lässt das erzeugte Sudoku auf Plausibilität prüfen. Indem er die Anzahl
// der möglichen Lösungswege als Array zurückgibt und in der SESSION "solutions" speichert.
// Mehr als 1 gilt als ungültig.
class ShowCreateCheckController extends BaseController
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
        $newBoard = new Board();
        $newBoard->setBoard($_SESSION['sudoku']);
        $newBoard->solutionsCount();
        // Die Methode "solutionsCount" ist rekursiv und verwendet Backtracking, um mögliche Lösungen zu zählen.
        // Das Attribut "solutionCount" wird dabei direkt manipuliert, weshalb wir hier direkt darauf zugreifen.
        $_SESSION['solutions'] = $newBoard->solutionCount;

        return ['arrayName' => 'solutionCount', 'data' => $newBoard->solutionCount];
    }

}