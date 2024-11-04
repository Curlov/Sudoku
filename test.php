<?php
// Liste der Felder
$felder = range(1, 9); // 1 bis 9 für 9 Felder

// Anzahl der Felder zum Ausblenden, zufällig zwischen 3 und 5
$anzahlZumAusblenden = rand(3, 6);

// Mische die Liste und wähle die ersten n Felder
shuffle($felder);
$felderZumAusblenden = array_slice($felder, 0, $anzahlZumAusblenden);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Felder ausblenden</title>
    <style>
        .feld {
            padding: 10px;
            border: 1px solid #333;
            margin: 5px;
            width: 100px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<?php
// Felder ausgeben
for ($i = 1; $i <= 9; $i++) {
    // Überprüfen, ob das Feld in der Auswahl zum Ausblenden ist
    $class = in_array($i, $felderZumAusblenden) ? "hidden" : "";
    echo "<div class='feld $class'>Feld $i</div>";
}
?>

</body>
</html>
