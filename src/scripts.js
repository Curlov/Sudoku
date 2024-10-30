function showRegisterField() {
    event.preventDefault()
    const div = document.getElementById("registerContainer");
    const currentDisplay = window.getComputedStyle(div).display;
    if (currentDisplay === "none") {
        div.style.display = "block";
    } else {
        div.style.display = "none";
    }
}
