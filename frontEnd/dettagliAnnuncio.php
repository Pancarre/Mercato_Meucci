<?php

include "../backEnd/connessione.php";
include "../backEnd/check_session.php";


$annuncio_id = isset($_GET['id']) ? intval($_GET['id']) : null;

$sql = 
"SELECT annuncio.*, utente.username,utente.email,utente.telefono
FROM annuncio 
JOIN utente ON annuncio.id_utente = utente.id 
WHERE annuncio.id_annuncio = '$annuncio_id'";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Annuncio non trovato";
    exit;
}

$row = $result->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div>
        <?php
        echo "<h1>" . $row["nome"] . "</h1>";
        echo "<img src='" . $row["image"] . "' width='200px'>";
        echo "<h3>Descrizione</h3>";
        echo "<p>" . $row["descrizione"] . "</p><br>";
        echo "<p>" . "Pubblicato da: ". $row["username"] . "</p><br>";
       
        ?>
        <h3>Contattami</h3>
        <?php
        echo "<p>" . $row["email"] . "</p>";
        echo "<p>" . $row["telefono"] . "</p>";
        ?>
    </div>


    <h3>Fai una proposta</h3>
    <form action="../backEnd/inviaProposta.php" method="post">
        <input type="hidden" name="annuncio_id" value="<?php echo $annuncio_id; ?>">
        <div class="mb-3">
            <label for="prezzo" class="form-label">Prezzo proposto:</label>
            <input type="number" class="form-control" id="prezzo" name="prezzo" required> <br>
            <textarea name="descrizione" class="form-control" cols="30" rows="10" max length="200" placeholder="Inserisci una descrizione" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Invia proposta</button>
    </form>


</body>
</html>