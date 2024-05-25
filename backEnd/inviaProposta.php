<?php

include "connessione.php";
include "check_session.php";

$annuncio_id = intval($_POST["annuncio_id"]);
$proponente = $_SESSION["username"];
$prezzo =floatval($_POST["prezzo"]);
$descrizione = $_POST["descrizione"];

// Recupero l'id dell'utente
$sql ="SELECT id FROM utente WHERE username = '$proponente'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $utente_id = $row["id"];

    // Verifica se l'utente ha già fatto una proposta per questo annuncio
    $sql = "SELECT * FROM proposta WHERE id_annuncio = '$annuncio_id' AND id_utente = '$utente_id'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        echo "errore: l'utente ha gia proposto per questo annuncio";
        exit();
    } else {
        // Inserimento della proposta
        $sql = "INSERT INTO proposta (id_annuncio,id_utente,prezzo_proposto,descrizione) VALUES ('$annuncio_id','$utente_id','$prezzo','$descrizione')";
        
        if($conn->query($sql)) {
            echo "proposta inviata con successo";
        } else {
            echo "errore durante l'inserimento della proposta";
        }

    }
    
} 



?>