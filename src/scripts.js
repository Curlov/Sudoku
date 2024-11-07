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
        cell.style.backgroundColor = 'rgb(231, 231, 231)';
    });
}

// Funktion zum Markieren der gesamten Spalte
function highlightColumn(col) {
    const cells = table.querySelectorAll('td');
    cells.forEach(cell => {
        if (parseInt(cell.getAttribute('data-cell')) % 10 === col) {
            cell.style.backgroundColor = 'rgb(231, 231, 231)';
        }
    });
}

// Funktion zum Entfernen der Markierung der Zeilen und Spalten
function removeRowColHighlight() {
    const rows = table.querySelectorAll('tr');
    rows.forEach(row => {
        row.querySelectorAll('.cell').forEach(cell => {
            cell.style.backgroundColor = '';
        });
    });
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
        memory = cell.getAttribute('data-cell');
        hiddenField.value = memory;

        // Berechne Zeile und Spalte und Feld
        lastClickedRow = Math.floor(memory / 10);
        lastClickedCol = memory % 10;
        lastField = Math.floor((lastClickedRow - 1) / 3) * 3 + Math.floor((lastClickedCol - 1) / 3) + 1;

        console.log(lastField);

        // Entferne Markierung der vorherigen Zelle und Zeile/Spalte
        if (lastClickedCell) {
            lastClickedCell.style.backgroundColor = '';
            // Entferne die Hintergrundfarbe der gesamten Zeile und Spalte
            removeRowColHighlight();
        }

        // Markiere alle Zellen in der gleichen Zeile
        highlightRow(lastClickedRow);

        // Markiere alle Zellen in der gleichen Spalte
        highlightColumn(lastClickedCol);

        // Markiere die angeklickte Zelle
        cell.style.backgroundColor = 'rgb(230, 211, 250)';
        lastClickedCell = cell;

    }

});

