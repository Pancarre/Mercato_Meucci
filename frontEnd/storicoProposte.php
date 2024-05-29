<?php
include "../backEnd/connessione.php";
include "../backEnd/check_session.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="../style/storicoProposte.css">
    <title>Document</title>
</head>
<body>

<div class="container-fluid">

<div class="row">
    <div class="col-1 text-center pt-2 pb-2 border border-5" id="arrow-back">
                
        
        <a href="./home.php">
            
            <div id="arrow-back">
                <span class="material-symbols-outlined">
                    arrow_back
                </span>
            </div>
        </a>
        
    </div>
    <div class="col-11" id="blue">
        <h1>Storico delle proposte effettuate</h1>
    </div>
</div>
</div>


    <?php

    $username = $_SESSION['username'];
    $sql = "SELECT id FROM utente WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_utente = $row["id"];
    }
    $sql = "SELECT proposta.*, annuncio.*, stato.nome AS statoNome
            FROM proposta 
            JOIN annuncio ON proposta.id_annuncio = annuncio.id_annuncio 
            JOIN stato ON proposta.id_stato = stato.id
            WHERE proposta.id_utente = '$id_utente'";
    $result = $conn->query($sql);

    if (!$result) {
        echo "Errore nella query: " . $conn->error;
    } else if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='container-fluid col-4 float-start mt-4'>";
            echo "<div class='card' id='card'>";
            echo "<div class='card-header text-center'><h1>".$row["nome"]."</h1></div>";
            echo "<div class='card-body'>";

                        echo "<div >";
                            echo "<a href='./dettagliAnnuncio.php?id=" . $row["id_annuncio"] . "&from=storico'>";
                            echo "<img src='" . $row["image"] . "' class='img-fluid' alt='immagine annuncio'>"; // 'img-fluid' per rendere l'immagine reattiva
                            echo "</a>";
                        echo "</div>";
                        echo "<div>";
                            echo "<p>Stato: " . $row["stato_di_disponibilità"]  . "</p>";
                            echo "<p>Prezzo Proposto: " . $row["prezzo_proposto"] . "</p>";
                            echo "<p>Data Proposta: " . $row["data_proposta"] . "</p>";    
                            echo "<p>Stato: " . $row["statoNome"] . "</p>";
                        echo "</div>";

            echo "</div>";
        echo "</div>";
        
        }
    } else {
        echo "<p class='text-center'>Non ci sono proposte per questo utente.</p>";
    }

    ?>
</body>
</html>
