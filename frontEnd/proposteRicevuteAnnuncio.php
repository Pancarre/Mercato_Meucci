<?php

include "../backEnd/connessione.php";
include "../backEnd/check_session.php";


$annuncio_id = isset($_GET['id_annuncio']) ? intval($_GET['id_annuncio']) : 0;

$sql = "SELECT proposta.*, utente.username 
FROM proposta 
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
        echo "<p>" . $row["prezzo"] . "</p>";
        echo "<p>" . $row["descrizione"] . "</p>";
        echo "</div>";
    }

} else {
    echo "<p>Non ci sono proposte per questo annuncio</p>";
}

?>