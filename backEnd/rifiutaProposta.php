<?php

include "./connessione.php";

$id_proposta = intval($_POST["id_proposta"]);
$id_annuncio = intval($_POST["id_annuncio"]);

// Rifiuto della proposta
$sql = "UPDATE proposta SET id_stato = 3 WHERE id = '$id_proposta'";
$result = $conn->query($sql);

$link = "../frontEnd/proposteRicevuteAnnuncio.php?id_annuncio=" . $id_annuncio;

header("Location: $link");
?>