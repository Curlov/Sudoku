<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    </style>
</head>
<body>
<form id="toggleForm" action="index.php" method="post">
    <input type="hidden" name="note" id="noteHidden" value="<?php echo isset($_SESSION['note']) ? $_SESSION['note'] : 0; ?>">
    <button type="button" id="toggleButton" class="buttonAction2">
        <?php echo isset($_SESSION['note']) && $_SESSION['note'] == 1 ? 'Aktiviert' : 'Deaktiviert'; ?>
    </button>
    <input type="submit" value="Speichern">
</form>

<script>
    const toggleButton = document.getElementById('toggleButton');
    const noteHidden = document.getElementById('noteHidden');

    toggleButton.addEventListener('click', () => {
        if (noteHidden.value == 1) {
            noteHidden.value = 0;
            toggleButton.textContent = 'Deaktiviert';
            toggleButton.classList.remove('active'); // Optional, falls du eine "aktive" Klasse hast
        } else {
            noteHidden.value = 1;
            toggleButton.textContent = 'Aktiviert';
            toggleButton.classList.add('active');
        }
    });
</script>
</body>
</html>
