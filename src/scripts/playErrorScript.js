// Funktion, um den Fehlerstatus beim Laden der Seite zu prüfen
function checkErrorStatus() {
    const errorStatus = document.getElementById("errorStatus").getAttribute("data-error");
    if (errorStatus === "true") {
        errorSound.play();
    }
}

const errorSound = new Audio('src/sound/error.mp3');

window.addEventListener("DOMContentLoaded", checkErrorStatus);

window.onload = function() {
    document.body.style.visibility = 'visible';
};