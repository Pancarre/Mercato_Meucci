<?php

include "../backEnd/connessione.php";
include "../backEnd/check_session.php";

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