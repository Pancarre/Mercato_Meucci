<?php
include '../backEnd/check_session.php';
include '../backEnd/connessione.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/inseriscifile.css">
    <link rel="icon" href="../img/logo---itis-meucci---firenze.png" type="image/png">
    <title>Document</title>
</head>
<body>
   
    <div class="container-fluid d-flex justify-content-center">
    <div class="col-3 d-none d-md-flex"></div>
    <div class="col-12 col-md-6 ">
    <form method="post" action="../backEnd/scriptInserisciFile.php" enctype="multipart/form-data">
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
		<a href="./home.php">tornare a home</a>

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

    
    </div>
    <div class="col-3 d-none d-md-flex"></div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>