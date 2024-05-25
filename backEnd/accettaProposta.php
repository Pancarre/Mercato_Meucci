<?php

include "./connessione.php";

$id_proposta = intval($_POST["id_proposta"]);
$id_annuncio = $_POST["id_annuncio"];

// Accettazione della proposta
$sql = "UPDATE proposta SET id_stato = 2 WHERE id = '$id_proposta'";
$result = $conn->query($sql);

// Rifiuto delle altre proposte relative allo stesso annuncio
$sql = "UPDATE proposta SET id_stato = 3 WHERE id_annuncio = '$id_annuncio' AND id != '$id_proposta'";
$result = $conn->query($sql);

// Rendo l'annuncio invisibile
$sql_annuncio = "UPDATE annuncio SET stato_di_disponibilità = 'Non Disponibile' WHERE id_annuncio = '$id_annuncio'";
$result_annuncio = $conn->query($sql_annuncio);

$link = "../frontEnd/proposteRicevuteAnnuncio.php?id_annuncio=" . $id_annuncio;

header("Location: $link");



?>