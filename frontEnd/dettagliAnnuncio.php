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
    echo "Annuncio non trovato";
    exit;
}

$row = $result->fetch_assoc();

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
    <title>Document</title>
</head>
<body>

<div class="container-fluid">
    <div class="row">
      <div class="col-4">
        <h2>Nome prodotto : <?php echo $row["nome"]; ?></h2>

          <img class="img-fluid m-0" src="<?php echo $row["image"]; ?>">

          <table>

            <h2>INFO</h2>

          <tr>
            <th>Pubblicato da</th>
            <td><?php echo "<a href='./mostraProfilo.php?id=" . $row["id_utente"] . "'>" . $row["utenteUsername"]  . "</a>" ?></td>
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
                  <form action="../backEnd/inviaProposta.php" method="post">
                      <input type="hidden" name="annuncio_id" value="<?php echo $annuncio_id; ?>">
                      <div class="mb-3">
                          <p>Prezzo proposto:</p>
                          <input type="number" class="form-control" id="prezzo" name="prezzo" required> <br>
                          <textarea style="resize: none;" name="descrizione" class="form-control" cols="30" rows="10" maxlength="200" placeholder="Inserisci una descrizione" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Invia proposta</button>
                      
                  </form>
              <?php endif; ?>
              <?php
              echo "<a href=" . $_SESSION["pagina_precedente"] . ">ritorna a pagina precedente</a>"
            ?>
        </div>
        <div class="col-6">
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
              echo "<h1>Proposte ricevute</h1>";	
              while($row = $result->fetch_assoc()) {
                  $counter++;
                  echo "<div>";
                  echo "<h3>Proposta #" . $counter  . "</h3>";
                  echo "<p>" . $row["username"] . "</p>";
                  echo "<p>" . $row["prezzo_proposto"] . "</p>";
                  echo "<p>" . $row["descrizione"] . "</p>";
                  echo "<p>Stato della proposta: " . $row["nome"] . "</p>";

                  // Form per accettare la proposta
                  if($row["id_stato"] == 1  && $username == $row["username"]){
                      echo "<form action='../backEnd/accettaProposta.php' method='post'>";
                      echo "<input type='hidden' name='id_proposta' value='" . $row["id"] . "'>";
                      echo "<input type='hidden' name='id_annuncio' value='" . $row["id_annuncio"] . "'>";
                      echo "<button type='submit' name='accetta' value='accetta'>Accetta</button>";
                      echo "</form>";
                  } else {
                      echo "<button value='accetta' disabled>Accetta</button>";
                  }
                  // Form per rifiutare la proposta
                  if($row["id_stato"] == 1 && $username == $row["username"]){
                  echo "<form action='../backEnd/rifiutaProposta.php' method='post'>";
                  echo "<input type='hidden' name='id_proposta' value='" . $row["id"] . "'>";
                  echo "<input type='hidden' name='id_annuncio' value='" . $row["id_annuncio"] . "'>";
                  echo "<button type='submit' name='rifiuta' value='rifiuta'>Rifiuta</button>";
                  echo "</form>";
                  } else {
                      echo "<button value='rifiuta' disabled>Rifiuta</button>";
                  }

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