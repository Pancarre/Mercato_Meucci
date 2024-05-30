<?php
    include "../backEnd/connessione.php";
    include "../backEnd/check_session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offcanvas Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/home.css">
    <link rel="icon" href="../img/logo---itis-meucci---firenze.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>
<body>
    
    <nav class="navbar navbar-expand-lg fixed-top blue" >
        <div class="container-fluid">
        <a class="btn btn-primary border blue me-2" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
            <span class="material-symbols-outlined pt-1">
                menu
            </span>
        </a>
          <a class="navbar-brand text-light" href="#">
            <img src="../img/logo---itis-meucci---firenze.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                Meucci
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">

            
              </li>
            </ul>

            <form class="d-flex" action="./home.php" method="get">

                    <select id="filtro" class="form-select" name="categoria">
                        <option value="" selected>Tutte le categorie</option>
                        <option value="1">Telefonia</option>
                        <option value="2">Videogiochi</option>
                        <option value="3">Informatica</option>
                        <option value="4">Libri</option> 
                    </select>
                    <button id="button-login" type="submit" class="btn btn-primary border blue">Filtra</button>

            </form>
          </div>
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
                  echo "<p class='mb-0'>User</p><a href='./mostraProfilo.php'>" . $_SESSION["username"] . "</a><br>";
              ?>
          </div>

          <a href="./inserisciFile.php" >
              <div class="profilo-option">
                  <span>Inserisci Annuncio</span>
              </div>
          </a>
          <a href="./storicoAnnunci.php">
              <div class="profilo-option">
                  <span>Storico Annunci</span>
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

                    <h1>Annunci degli altri utenti</h1>

                </div>

                <div class="mt-2 col-12 col-lg-6">

                </div>

                <div class="col-12">

                    <?php

                        // Prendo l'id dell'utente loggato
                        $username = $_SESSION["username"];
                        $sql = "SELECT id FROM utente WHERE username = '$username'";
                        $result = $conn->query($sql);

                        if($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $id = $row["id"];
                            $categoria_id = isset($_GET['categoria']) ? $_GET['categoria'] : '';

                            // Seleziona gli annunci che gli utenti hanno pubblicato ad eccezione di quelli di $id
                            $sql = "SELECT annuncio.*, utente.username FROM annuncio JOIN utente ON annuncio.id_utente = utente.id WHERE annuncio.id_utente != '$id'";
                            
                            if (!empty($categoria_id)) {
                                $sql .= " AND annuncio.id_categoria = '$categoria_id'";
                            }

                            $result = $conn->query($sql);

                            // Mostra tutti gli annunci
                            if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<div id='card-container' class='container-fluid col-12 col-sm-6 col-lg-4 float-start mt-4'>";
                                        echo "<div class='card' id='card'>";
                                            echo "<div class='card-header'><h3>".$row["nome"]."</h3></div>";
                                                echo "<div class='card-body'>";
                                                    echo "<div class='container-fluid'>";
                                                        echo "<div class='row'>";
                                                            echo "<div class='col-12 col-md-6'>";
                                                                echo "<a href='./dettagliAnnuncio.php?id=" . $row["id_annuncio"] . "'>";
                                                                echo "<img src='" . $row["image"] . "' class='img-fluid' alt='immagine annuncio' width='75px'>"; // 'img-fluid' per rendere l'immagine reattiva
                                                                echo "</a>";
                                                            echo "</div>";
                                                            echo "<div class='col-12 col-md-6'>";
                                                                echo "<p class='card-title'>" .  $row["data_creazione"] . "</p>";
                                                                echo "<p>" . $row["stato_di_disponibilità"]  . "</p>";
                                                                echo "<form action='./proposteRicevuteAnnuncio.php' method='get'>";
                                                                echo "<input type='hidden' name='id_annuncio' value='" . $row["id_annuncio"] . "'>";
                                                                echo "<input type='submit' class='btn btn-primary card-btn' value='Visualizza Proposte'>"; // Aggiunta di una classe Bootstrap al bottone
                                                                echo "</form>";
                                                            echo "</div>";
                                                        echo "</div>";
                                                    echo "</div>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                    
                                
                                }
                            } else {
                                echo "<p class='text-center mt-5'>Non ci sono annunci da mostrare!</p>";
                            }
                        } 

                    ?>

                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
