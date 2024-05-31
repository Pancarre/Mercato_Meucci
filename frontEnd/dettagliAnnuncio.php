<?php

include "../backEnd/connessione.php";
include "../backEnd/check_session.php";


$annuncio_id = isset($_GET['id_annuncio']) ? intval($_GET['id_annuncio']) : null;

$sql = 
"SELECT annuncio.*, utente.username AS utenteUsername,utente.email,utente.telefono
FROM annuncio 
JOIN utente ON annuncio.id_utente = utente.id 
WHERE annuncio.id_annuncio = '$annuncio_id'";

$result = $conn->query($sql);


if ($result->num_rows == 0) {
    $_SESSION["errore"]= "Annuncio non trovato";
    header("./home.php");
    exit;
}

$row = $result->fetch_assoc();
$proprietario = $row["utenteUsername"];

$from_storico = isset($_GET['from']) && $_GET['from'] === 'storico';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/dettagliannuncio.css">
    <link rel="icon" href="../img/logo---itis-meucci---firenze.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

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
                Home
          </a>

            <button class="navbar-toggler border-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="material-symbols-outlined text-light">
                arrow_downward
            </span>
            </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <?php
                  echo "<a class='text-light' href=" . $_SESSION["pagina_precedente"] . ">ritorna a pagina precedente</a>"
                ?>
              </li>
            </ul>

           <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Aggiungi una Proposta
            </button>
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
                  echo "<p class='mb-0'>User</p><a href='./mostraProfilo.php?from=profilo'>" . $_SESSION["username"] . "</a><br>";
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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuova Proposta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php if (!$from_storico): ?>

        <!-- Mostra la sezione "Fai una proposta" solo se l'utente non proviene dalla pagina storiccoAnnunci.php -->
        <h3>Fai una proposta</h3>
        <?php
          if(isset($_SESSION["errore"])){
              echo "<h3 class='text-danger'>" . $_SESSION['errore'] . "</h3>";
              unset($_SESSION["errore"]);
            }
          else if(isset($_SESSION["report"])){

            echo "<h3 class='text-danger'>" . $_SESSION['report'] . "</h3>";
            unset($_SESSION["report"]);

          }
        ?>
        <form action="../backEnd/inviaProposta.php?" method="post">
            <input type="hidden" name="annuncio_id" value="<?php echo $annuncio_id; ?>">
            <div class="mb-3">
                <p>Prezzo proposto:</p>
                <input type="number" class="form-control" id="prezzo" name="prezzo" required> <br>
                <textarea style="resize: none;" name="descrizione" class="form-control" cols="30" rows="10" maxlength="200" placeholder="Inserisci una descrizione" required></textarea>
            </div>

        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Invia proposta</button>
        </form>
      </div>
    </div>
  </div>
</div>






<div class="container-fluid" id="main">
    <div class="row">
      <div class="col-12 col-md-4 border border-black">
        <h2 class="text-center py-2">Nome prodotto : <?php echo $row["nome"]; ?></h2>
          <div class="d-flex flex-column align-items-center mb-3">
          <img class="img-fluid m-0 " src="<?php echo $row["image"]; ?>">

          </div>

          <table>

            <h2 class="text-center">INFO</h2>

          <tr>
            <th>Pubblicato da</th>
            <td><?php echo "<a href='./mostraProfilo.php?id=" . $row["id_utente"] . "'>" . $proprietario  . "</a>" ?></td>
          </tr>
          <tr>
            <th>Data creazione</th>
            <td><?php echo $row["data_creazione"]; ?></td>
          </tr>
          </table>

          <h3>Contattami</h3>

          <table>
            <tr>
            <th>Email</th> 
            <td><?php echo $row["email"]; ?></td>
          </tr>
          <tr>
            <th>Telefono</th>
            <td><?php echo $row["telefono"]; ?></td>
          </tr>
          </table>

          <h1>Descrizione</h1>

          <?php
              echo "<textarea style='resize: none;' name='descrizione' class='form-control' cols='30' rows='10' maxlength='200' placeholder='Inserisci una descrizione' readonly>" . $row["descrizione"] . "</textarea>";  

          ?>
          
        </div>
        <div class="col-12 col-md-8 border border-black">
          <h1>Proposte ricevute</h1>
          <?php

          $username = $_SESSION['username'];

          $annuncio_id = isset($_GET['id_annuncio']) ? intval($_GET['id_annuncio']) : 0;

          $sql = "SELECT proposta.*, utente.username,stato.nome
          FROM proposta 
          join stato on stato.id = proposta.id_stato
          JOIN utente ON proposta.id_utente = utente.id 
          WHERE proposta.id_annuncio = '$annuncio_id'";

          $result = $conn->query($sql);

          if($result->num_rows > 0) {
              $counter = 0;
              
              while($row = $result->fetch_assoc()) {
                  $counter++;
                  echo "<div class='container-fluid border border-dark rounded  '>";
                  echo "<div class='row'>";
                      echo "<div class='col-12 col-lg-5 border-end border-dark rounded'>";
              
                          echo "<h3>Proposta #" . $counter  . "</h3>";
                          echo "<span>Effettuato da: <span><a href='./mostraProfilo.php?id=" . $row["id_utente"] . "'>" . $row["username"]  . "</a>";
                          echo "<p>Prezzo proposto: " . $row["prezzo_proposto"] . "€</p>";
                          echo "<p>" . $row["nome"] . "</p>";
                      echo "</div>";
                      echo "<div class='col-12 col-lg-7'>";
              
                          echo "<textarea name='descrizione' style='height: 140px;' class='form-control' cols='30' rows='10' placeholder='Inserisci una descrizione' readonly>" . $row["descrizione"] . "</textarea>";  
                          // Form per accettare la proposta
                          if($row["id_stato"] == 1  && $username == $proprietario){
                              echo "<form action='../backEnd/accettaProposta.php' method='post'>";
                              echo "<input type='hidden' name='id_proposta' value='" . $row["id"] . "'>";
                              echo "<input type='hidden' name='id_annuncio' value='" . $row["id_annuncio"] . "'>";
                              echo "<button class='float-end my-3' type='submit' name='accetta' value='accetta'>Accetta</button>";
                              echo "</form>";
                          } else {
                              echo "<button class='float-end my-3' value='accetta' disabled>Accetta</button>";
                          }
                          // Form per rifiutare la proposta
                          if($row["id_stato"] == 1 && $username == $proprietario){
                              echo "<form action='../backEnd/rifiutaProposta.php' method='post'>";
                              echo "<input type='hidden' name='id_proposta' value='" . $row["id"] . "'>";
                              echo "<input type='hidden' name='id_annuncio' value='" . $row["id_annuncio"] . "'>";
                              echo "<button class='float-end my-3' type='submit' name='rifiuta' value='rifiuta'>Rifiuta</button>";
                              echo "</form>";
                          } else {
                              echo "<button class='float-end my-3' value='rifiuta' disabled>Rifiuta</button>";
                          }
                      echo "</div>";
                  echo "</div>";
              echo "</div>";
              }

          } else {
              echo "<p>Non ci sono proposte per questo annuncio</p>";
          }

          ?>

    </div>
      
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>