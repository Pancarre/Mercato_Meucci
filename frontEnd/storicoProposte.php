<?php
include "../backEnd/connessione.php";
include "../backEnd/check_session.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storico delle Proposte Effettuate</title>
</head>
<body>
    <h1>Storico delle proposte effettuate</h1>
    <?php

    $username = $_SESSION['username'];
    $sql = "SELECT id FROM utente WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_utente = $row["id"];
    }

    $sql = "SELECT proposta.*, annuncio.image, annuncio.nome AS annuncioNome, stato.nome AS statoNome
            FROM proposta 
            JOIN annuncio ON proposta.id_annuncio = annuncio.id_annuncio 
            JOIN stato ON proposta.id_stato = stato.id
            WHERE proposta.id_utente = '$id_utente'";
    $result = $conn->query($sql);

    if (!$result) {
        echo "Errore nella query: " . $conn->error;
    } else if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<img src='" . $row["image"] . "' width='50px'>";
            echo "<p>Annuncio: " . $row["annuncioNome"] . "</p>";
            echo "<p>Prezzo Proposto: " . $row["prezzo_proposto"] . "</p>";
            echo "<p>Data Proposta: " . $row["data_proposta"] . "</p>";    
            echo "<p>Stato: " . $row["statoNome"] . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Non ci sono proposte per questo utente.</p>";
        echo "<a href='./home.php'>torna a home</a>";
    }

    ?>
</body>
</html>