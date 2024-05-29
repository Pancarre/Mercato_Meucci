<?php
include "../backEnd/connessione.php";
include "../backEnd/check_session.php";

$username = $_SESSION['username'];

$sql = "SELECT id FROM utente WHERE username = '$username'";
$result = $conn->query($sql);

// Assegno l'id dell'utente
$id_utente = null;
if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_utente = $row['id'];
}


$sql = "SELECT username,eta,email,telefono,nome,cognome,immagine_profilo,classe.classe,classe.specialità FROM utente JOIN classe ON utente.id_classe = classe.id_classe WHERE utente.id='$id_utente'";  
$result = $conn->query($sql);






?>