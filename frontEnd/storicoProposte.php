<?php
include "../backEnd/connessione.php";
include "../backEnd/check_session.php";
$_SESSION["pagina_precedente"] = "./storicoProposte.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="../style/storicoProposte.css">
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
                Storico Proposte
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
          <a href="./storicoAnnunci.php">
              <div class="profilo-option">
                  <span>Storico Annunci</span>
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

                <div class="col-12 text-center" >

                    <h1 style="padding-top: 80px;">Storico Proposte</h1>

                </div>

                <div class="col-12">

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
                                echo "<div class='container-fluid col-12 col-lg-6 float-start mt-4'>";
                                    echo "<div class='card' id='card'>";
                                        echo "<div class='card-header text-center'><h2 class='fitted-text pt-2'>".$row["nome"]."</h2></div>";
                                            echo "<div class='card-body'>";
                                            echo "<div class='container-fluid '>";
                                            echo "<div class='row'>";
                                                echo "<div class='col-6 d-flex justify-content-center align-items-center'>";
                                                    echo "<a href='./dettagliAnnuncio.php?id_annuncio=" . $row["id_annuncio"] . "'>";
                                                    echo "<img src='" . $row["image"] . "' class='img-fluid' alt='immagine annuncio' width='75px'>"; // 'img-fluid' per rendere l'immagine reattiva
                                                    echo "</a>";
                                                echo "</div>";
                                                echo "<div class='col-6'>";
                                                    echo "<p>Prezzo Proposto: " . $row["prezzo_proposto"] . "</p>";
                                                    echo "<p>Data Proposta: " . $row["data_proposta"] . "</p>";    
                                                    echo "<p>Stato: " . $row["statoNome"] . "</p>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";


                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                            
                            }
                        } else {
                            echo "<p class='text-center mt-5'>Non ci sono proposte per questo utente.</p>";
                        }

                    ?>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
