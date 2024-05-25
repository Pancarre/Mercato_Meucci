<?php
include "../backEnd/connessione.php";
include "../backEnd/check_session.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Storico degli annunci</h1>
    <?php

    // Recupero l'id dell'utente
    $username = $_SESSION['username'];
    $sql = "SELECT id FROM utente WHERE username = '$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_utente = $row["id"];
    
        // Recupero tutti gli annunci dell'utente
        $sql = "SELECT * FROM annuncio WHERE id_utente = '$id_utente'";
        $result = $conn->query($sql);
    
        // Creazione degli annunci
        if($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                echo "<div>";
                // dati dell'annuncio
                echo "<a href='./dettagliAnnuncio.php?id=" . $row["id_annuncio"] . "&from=storico'>";
                echo "<img src='" . $row["image"] . "' width='50px'>";	
                echo "<p>" . $row["nome"] . "</p>";
                echo "</a>";
                echo "<p>" . $row["data_creazione"] . "</p>";
                echo "<p>Stato: " . $row["stato_di_disponibilità"]  . "</p>";
                // FORM per visualizzare le proposte
                echo "<form action='./proposteRicevuteAnnuncio.php' method='get'>";
                echo "<input type='hidden' name='id_annuncio' value='" . $row["id_annuncio"] . "'>";
                echo "<input type='submit' value='Visualizza proposte'><br>";
                echo "</form>";
                // FORM per elminare l'annuncio
                if($row["stato_di_disponibilità"] !== 'Non Disponibile') {
                    echo "<form action='../backEnd/eliminaAnnuncio.php' method='post'>";
                    echo "<input type='hidden' name='id_annuncio' value='" . $row["id_annuncio"] . "'>";
                    echo "<input type='submit' value='Elimina Annuncio'>";
                    echo "</form>";
                } else {
                    // Se l'annuncio è già stato eliminato o non è più disponibile, disabilita il tasto "Elimina Annuncio"
                    echo "<button type='button' disabled>Elimina Annuncio</button>";
                }

                echo "</div>";
            }          
    
        } else {
            echo "<p>Non ci sono annunci</p>";
            $_SESSION["error"] = "errore: nessun annuncio trovato";
        }
    } else {
        $_SESSION["error"] = "errore: utente non trovato";
    }



    ?>
    
</body>
</html>