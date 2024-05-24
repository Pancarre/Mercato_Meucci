<?php
include '../backEnd/check_session.php';
include '../backEnd/connessione.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="../backEnd/scriptinseriscifile.php" enctype="multipart/form-data">
        <label for="titolo">Titolo dell'annuncio:</label>
        <input type="text" name="titolo" placeholder="titolo" required><br>
        <div id="imagePreview"></div>
        <input type="file" name="imgprofilo" onchange="previewImage(event)" required><br>
        <label for="categoria">Categoria</label>
        <select id="categoria" name="categoria" required>
            <option value="telefonia">Telefonia</option>
            <option value="videogiochi">Videogiochi</option>
            <option value="informatica">Informatica</option>
            <option value="libri">Libri</option>
        </select><br>	
        <label for="description">Descrizione:</label>
        <textarea id="description" name="descrizione" rows="10" cols="50" maxlength="255" required></textarea><br>
        

        <input type="submit">


        <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.innerHTML = '<img src="' + reader.result + '" width="200">';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
        </script>


    </form>
</body>
</html>