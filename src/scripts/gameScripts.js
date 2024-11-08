// Array für Zellen in Feld Zuweisung
let field = [];
    field[1] = {1: [1, 1], 2: [2, 1], 3: [3, 1], 4: [1, 2], 5: [2, 2], 6: [3, 2], 7: [1, 3], 8: [2, 3], 9: [3, 3]};
    field[2] = {1: [4, 1], 2: [5, 1], 3: [6, 1], 4: [4, 2], 5: [5, 2], 6: [6, 2], 7: [4, 3], 8: [5, 3], 9: [6, 3]};
    field[3] = {1: [7, 1], 2: [8, 1], 3: [9, 1], 4: [7, 2], 5: [8, 2], 6: [9, 2], 7: [7, 3], 8: [8, 3], 9: [9, 3]};
    field[4] = {1: [1, 4], 2: [2, 4], 3: [3, 4], 4: [1, 5], 5: [2, 5], 6: [3, 5], 7: [1, 6], 8: [2, 6], 9: [3, 6]};
    field[5] = {1: [4, 4], 2: [5, 4], 3: [6, 4], 4: [4, 5], 5: [5, 5], 6: [6, 5], 7: [4, 6], 8: [5, 6], 9: [6, 6]};
    field[6] = {1: [7, 4], 2: [8, 4], 3: [9, 4], 4: [7, 5], 5: [8, 5], 6: [9, 5], 7: [7, 6], 8: [8, 6], 9: [9, 6]};
    field[7] = {1: [1, 7], 2: [2, 7], 3: [3, 7], 4: [1, 8], 5: [2, 8], 6: [3, 8], 7: [1, 9], 8: [2, 9], 9: [3, 9]};
    field[8] = {1: [4, 7], 2: [5, 7], 3: [6, 7], 4: [4, 8], 5: [5, 8], 6: [6, 8], 7: [4, 9], 8: [5, 9], 9: [6, 9]};
    field[9] = {1: [7, 7], 2: [8, 7], 3: [9, 7], 4: [7, 8], 5: [8, 8], 6: [9, 8], 7: [7, 9], 8: [8, 9], 9: [9, 9]};

// Funktion zum Speichern aller Markierungen
function saveHighlight() {
    const rowData = lastClickedRow ? lastClickedRow : null;
    const colData = lastClickedCol ? lastClickedCol : null;
    const fieldData = lastField ? lastField : null;
    const cellData = lastClickedCell ? lastClickedCell.getAttribute('data-cell') : null;
    //const cellValue = lastClickedCell ? lastClickedCell.firstChild?.nodeValue?.trim() || "" : null;

    localStorage.setItem('highlightData', JSON.stringify({
        row: rowData,
        col: colData,
        field: fieldData,
        cell: cellData,
      //  cellValue: cellValue
    }));
}

// Funktion zum Laden und Anwenden aller gespeicherten Markierungen
function loadHighlight() {
    const highlightData = JSON.parse(localStorage.getItem('highlightData'));
    if (highlightData) {
        if (highlightData.row) highlightRow(highlightData.row);
        if (highlightData.col) highlightColumn(highlightData.col);
        if (highlightData.field) highlightField(highlightData.field);

        const cell = document.querySelector(`[data-cell="${highlightData.cell}"]`);
        if (cell) {
            cell.style.backgroundColor = 'rgb(230, 211, 250)'; // Rosa Markierung für die zuletzt angeklickte Zelle
            const cellValue = cell.firstChild?.nodeValue?.trim() || "";
            if (cellValue && !isNaN(cellValue)) {
                highlightSameNumberCells(cellValue);
            }
        }
    }
}

// Funktion für den "Note" Schalter
function toggleNote() {
    const noteHidden = document.getElementById('noteHidden');
    const toggleButton = document.getElementById('toggleButton');

    if (noteHidden.value === '1') {
        noteHidden.value = 0;
        toggleButton.classList.remove('active');
    } else {
        noteHidden.value = 1;
        toggleButton.classList.add('active');
    }
}

// Funktion zum Markieren der gesamten Zeile
function highlightRow(row) {
    const rows = table.querySelectorAll('tr');
    rows[row - 1].querySelectorAll('.cell').forEach(cell => {
        cell.style.backgroundColor = 'rgb(230, 230, 230)';
    });
}

// Funktion zum Markieren der gesamten Spalte
function highlightColumn(col) {
    const cells = table.querySelectorAll('td');
    cells.forEach(cell => {
        if (parseInt(cell.getAttribute('data-cell')) % 10 === col) {
            cell.style.backgroundColor = 'rgb(230, 230, 230)';
        }
    });
}

// Funktion zum Markieren eines Feldes
function highlightField(lastField) {
    for (const cellKey in field[lastField]) {
        const [x, y] = field[lastField][cellKey];

        const cellSelector = `[data-cell="${x}${y}"]`;
        const cellElement = document.querySelector(cellSelector);

        if (cellElement) {
            cellElement.style.backgroundColor = 'rgb(230, 230, 230)';
        }
    }
}

// Funktion zum Markieren von Zellen mit derselben Zahl
function highlightSameNumberCells(cellValue) {
    const allCells = table.querySelectorAll('.cell');
    allCells.forEach(cell => {
        const value = cell.textContent.trim();
        // Prüfen, ob die Zelle nur eine Zahl direkt als Textknoten enthält
        if (cell.childNodes.length === 1 && cell.firstChild.nodeType === Node.TEXT_NODE && value === cellValue) {
            cell.style.backgroundColor = 'rgb(230, 211, 250)';
        }
    });
}

// Funktion zum Entfernen aller vorherigen Markierungen
function removeHighlight() {
    // Entfernt die Markierung von allen Zellen
    document.querySelectorAll('.cell').forEach(cell => cell.style.backgroundColor = '');
}

const table = document.querySelector('table');
const hiddenField = document.getElementById('hiddenField');
let lastClickedCell = null;
let lastClickedRow = null;
let lastClickedCol = null;
let lastField = null;
let memory = null;


table.addEventListener('click', function(event) {
    const cell = event.target.closest('.cell');

    if (cell) {
        const cellValue = cell.firstChild?.nodeValue?.trim() || "";

        memory = cell.getAttribute('data-cell');
        hiddenField.value = memory;

        // Berechne Zeile und Spalte und Feld
        lastClickedRow = Math.floor(memory / 10);
        lastClickedCol = memory % 10;
        lastField = Math.floor((lastClickedCol - 1) / 3) * 3 + Math.floor((lastClickedRow - 1) / 3) + 1;

        removeHighlight();

        highlightRow(lastClickedRow);
        highlightColumn(lastClickedCol);
        highlightField(lastField);

        // Markiere die angeklickte Zelle
        cell.style.backgroundColor = 'rgb(230, 211, 250)';
        lastClickedCell = cell;

        if (cellValue && !isNaN(cellValue)) {
            highlightSameNumberCells(cellValue);
        }

        // Speichere die aktuellen Markierungen
        saveHighlight();

    }
});

// Beim Laden der Seite die Markierungen wiederherstellen
document.addEventListener('DOMContentLoaded', loadHighlight);

window.onload = function() {
    document.body.style.visibility = 'visible';
};