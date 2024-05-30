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


<nav class="navbar navbar-expand-lg fixed-top blue" >
        <div class="container-fluid">
        <a class="btn btn-primary border blue me-2" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
            <span class="material-symbols-outlined pt-1">
                menu
            </span>
        </a>
          <a class="navbar-brand text-light" href="./home.php">
            <img src="../img/logo---itis-meucci---firenze.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                Storico Annunci
          </a>


            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">

            
              </li>
            </ul>

        </div>
      </nav>
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body blue" id="profilo">
          <div class="profilo-option">
              <?php
                  echo "<p class='mb-0'>User</p><a href='./mostraProfilo.php?from=profilo'>" . $_SESSION["username"] . "</a><br>";
              ?>
          </div>

          <a href="./home.php">
              <div class="profilo-option">
                  <span>Home</span>
              </div>
          </a>

          <a href="./inserisciFile.php" >
              <div class="profilo-option">
                  <span>Inserisci Annuncio</span>
              </div>
          </a>

          <a href="./storicoProposte.php">
              <div class="profilo-option">
                  <span>Storico delle proposte inviate</span>
              </div>
          </a>
          <a href="../backEnd/logout.php">
              <div class="profilo-option bg-danger">
                  <span>Logout</span>
              </div>
          </a>
        </div>
      </div>

    <div class="main-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 text-center">

                    <h1>Storico Annunci</h1>

                </div>

                <div class="col-12">
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
                                echo "<div class='container-fluid col-12 col-lg-6 float-start mt-4'>";
                                    echo "<div class='card' id='card'>";
                                        echo "<div class='card-header'><h2 class='fitted-text pt-2'>".$row["nome"]."</h2></div>";
                                            echo "<div class='card-body'>";
                                                echo "<div class='container-fluid'>";
                                                    echo "<div class='row'>";
                                                        echo "<div class='col-6 d-flex justify-content-center align-items-center'>";
                                                            echo "<a href='./dettagliAnnuncio.php?id=" . $row["id_annuncio"] . "&from=storico'>";
                                                            echo "<img src='" . $row["image"] . "' class='img-fluid' alt='immagine annuncio' width='75px'>"; // 'img-fluid' per rendere l'immagine reattiva
                                                            echo "</a>";
                                                        echo "</div>";
                                                        echo "<div class='col-6'>";
                                                            echo "<p class='card-title'>" .  $row["data_creazione"] . "</p>";
                                                            if($row["stato_di_disponibilità"]=="Disponibile"){

                                                                echo "<p classe='text-success mb-0'>" . $row["stato_di_disponibilità"]  . "</p>";

                                                            }
                                                            else{

                                                                echo "<p classe='text-danger mb-0'>" . $row["stato_di_disponibilità"]  . "</p>";


                                                            }
                                                            echo "<div class='container-fluid'>";
                                                                echo "<div class='row'>";
                                                                    echo "<div class='col-6'>";
                                                                        echo "<form action='./proposteRicevuteAnnuncio.php' method='get'>";
                                                                        echo "<input type='hidden' name='id_annuncio' value='" . $row["id_annuncio"] . "'>";
                                                                        echo "<input type='submit' class='btn btn-primary card-btn' value='proposte'>"; // Aggiunta di una classe Bootstrap al bottone
                                                                        echo "</form>";
                                                                    echo "</div>";
                                                                    echo "<div class='col-6'>";
                                                                        if($row["stato_di_disponibilità"] != 'Non Disponibile') {
                                                                            echo "<form action='../backEnd/eliminaAnnuncio.php' method='post'>";
                                                                            echo "<input type='hidden' name='id_annuncio' value='" . $row["id_annuncio"] . "'>";
                                                                            echo "<input class='btn btn-danger card-btn' type='submit' value='Elimina'>";
                                                                            echo "</form>";
                                                                        } else {
                                                                            // Se l'annuncio è già stato eliminato o non è più disponibile, disabilita il tasto "Elimina Annuncio"
                                                                            echo "<input disabled class='btn btn-secondary card-btn' type='submit' value='Elimina'>";
                                                                        }

                                                                    echo "</div>";
                                                                echo "</div>";
                                                            echo "</div>";
                                                        echo "</div>";
                                                    echo "</div>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                
                            }          
                    
                        } else {
                            echo "<p class='text-center mt-5'>Non ci sono Annunci.</p>";
                            $_SESSION["error"] = "errore: nessun annuncio trovato";
                        }
                    } else {
                        $_SESSION["error"] = "errore: utente non trovato";
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>