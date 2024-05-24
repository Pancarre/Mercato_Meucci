<?php

include "connessione.php";

session_start();

$titolo = $_POST["titolo"];
$target_dir = "../uploads/";
$target_file = $target_dir . $_FILES["imgprofilo"]["name"];
$categoria = $_POST["categoria"];
$descrizione = $_POST["descrizione"];

// Controllo che la categoria esista
$sql = "SELECT id_categoria FROM categoria WHERE tipo = '$categoria'";
$result = $conn->query($sql);

// Assegno l'id della categoria
$id_categoria = null;
if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_categoria = $row['id_categoria'];
} 

$sql = "SELECT id FROM utente WHERE username = '$_SESSION[username]'";
$result = $conn->query($sql);

// Assegno l'id dell'utente
$id_utente = null;
if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_utente = $row['id'];
}


if(move_uploaded_file($_FILES["imgprofilo"]["tmp_name"], $target_file)){
    

    $sql = "INSERT INTO annuncio (nome,image,descrizione, stato_di_disponibilità,id_utente, id_categoria) VALUES ('$titolo', '$target_file','$descrizione', 'Disponibile', '$id_utente', '$id_categoria')";
    $result = $conn->query($sql);

    if(!$result){
        echo "Errore durante l'inserimento annuncio";
        $_SESSION["error"] = "Errore durante l'inserimento annuncio";
    }

    header("Location: ../frontEnd/home.php");

} else {
    echo "Errore durante il caricamento dell'immagine";
    $_SESSION["error"] = "Errore durante il caricamento dell'immagine";

}








?>