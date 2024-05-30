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
    <link rel="stylesheet" href="../style/storicoAnnuncio.css">
    <link rel="icon" href="../img/logo---itis-meucci---firenze.png" type="image/png">
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
                    <h1>Storico degli annunci</h1>
            </div>
        </div>
    </div>

    
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
                echo "<div class='container-fluid col-4 float-start mt-4'>";
                    echo "<div class='card' id='card'>";
                        echo "<div class='card-header'><h3>".$row["nome"]."</h3></div>";
                            echo "<div class='card-body'>";
                                echo "<div class='container-fluid'>";
                                    echo "<div class='row'>";
                                        echo "<div class='col-12 col-md-6'>";
                                            echo "<a href='./dettagliAnnuncio.php?id=" . $row["id_annuncio"] . "&from=storico'>";
                                            echo "<img src='" . $row["image"] . "' class='img-fluid' alt='immagine annuncio' width='75px'>"; // 'img-fluid' per rendere l'immagine reattiva
                                            echo "</a>";
                                        echo "</div>";
                                        echo "<div class='col-12 col-md-6'>";
                                            echo "<p class='card-title'>" .  $row["data_creazione"] . "</p>";
                                            if($row["stato_di_disponibilità"]="Disponibile"){

                                                echo "<p classe='text-success'>Stato: " . $row["stato_di_disponibilità"]  . "</p>";

                                            }
                                            else{

                                                echo "<p classe='text-danger'>Stato: " . $row["stato_di_disponibilità"]  . "</p>";


                                            }
                                            echo "<form action='./proposteRicevuteAnnuncio.php' method='get'>";
                                            echo "<input type='hidden' name='id_annuncio' value='" . $row["id_annuncio"] . "'>";
                                            echo "<input type='submit' class='btn btn-primary card-btn' value='Visualizza proposte'>"; // Aggiunta di una classe Bootstrap al bottone
                                            echo "</form>";
                                            if($row["stato_di_disponibilità"] !== 'Non Disponibile') {
                                                echo "<form action='../backEnd/eliminaAnnuncio.php' method='post'>";
                                                echo "<input type='hidden' name='id_annuncio' value='" . $row["id_annuncio"] . "'>";
                                                echo "<input class='btn btn-danger card-btn' type='submit' value='Elimina Annuncio'>";
                                                echo "</form>";
                                            } else {
                                                // Se l'annuncio è già stato eliminato o non è più disponibile, disabilita il tasto "Elimina Annuncio"
                                                echo "<button type='button' disabled>Elimina Annuncio</button>";
                                            }
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>