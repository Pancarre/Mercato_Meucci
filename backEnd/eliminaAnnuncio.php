<?php

include "./connessione.php";
include "./check_session.php";


$annuncio_id = $_POST["id_annuncio"];


$sql_annuncio = "UPDATE annuncio SET stato_di_disponibilità = 'Non Disponibile' where id_annuncio = '$annuncio_id'";
$result_annuncio = $conn->query($sql_annuncio);

$sql_proposta = "UPDATE proposta SET id_stato = 3 WHERE id_annuncio = '$annuncio_id'";
$result_proposta = $conn->query($sql_proposta);

if ($result_annuncio && $result_proposta) {
    $_SESSION["annuncio_eliminato"] = true;
    header("Location: ../frontEnd/storicoAnnunci.php");
    
} else {
    $_SESSION["error"] = "Errore durante l'operazione.";
}




?>



