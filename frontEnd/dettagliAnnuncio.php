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

$from_storico = isset($_GET['from']) && $_GET['from'] === 'storico';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/dettagliannuncio.css">
    <title>Document</title>
</head>
<body>

<div class="grid-container">
    <div class="grid-item" id="imag1"></div>
    <div class="grid-item">
    <h2>Nome prodotto : <?php echo $row["nome"]; ?></h2>

 <img src="<?php echo $row["image"]; ?>">

 <table>

   <h2>Descrizione</h2>

 <tr>
   <th>Pubblicato da</th>
   <td><?php echo $row["username"]; ?></td>
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
 
   <?php if (!$from_storico): ?>
        <!-- Mostra la sezione "Fai una proposta" solo se l'utente non proviene dalla pagina storiccoAnnunci.php -->
        <h3>Fai una proposta</h3>
        <form action="../backEnd/inviaProposta.php" method="post">
            <input type="hidden" name="annuncio_id" value="<?php echo $annuncio_id; ?>">
            <div class="mb-3">
                <label for="prezzo" class="form-label">Prezzo proposto:</label>
                <input type="number" class="form-control" id="prezzo" name="prezzo" required> <br>
                <textarea name="descrizione" class="form-control" cols="30" rows="10" maxlength="200" placeholder="Inserisci una descrizione" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Invia proposta</button>
        </form>
    <?php endif; ?>
    
    </div>
    <div class="grid-item" id="imag3"></div>
  </div>

  <?php

    session_start();
    if(isset($_SESSION["errore"])){

        
        echo "<br><h3 class='text-danger'>errore: " . $_SESSION["errore"] ."</h3>";


    }

  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>