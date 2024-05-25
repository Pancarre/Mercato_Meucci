<?php

include 'connessione.php';
session_start();

$username = null;
$password = null;
$eta = null;
$email = null;
$telefono = null;
$classe = null;
$specialità = null;



if(isset($_POST['username'])) {
    $username = $_POST['username'];
}
if(isset($_POST['password'])) {
    $password = $_POST['password'];
}
if(isset($_POST['eta'])) {
    $eta = $_POST['eta'];
}
if(isset($_POST['email'])) {
    $email = $_POST['email'];
}
if(isset($_POST['telefono'])) {
    $telefono = $_POST['telefono'];
}
if(isset($_POST['classe'])) {
    $classe = $_POST['classe'];
}
if(isset($_POST['specialità'])) {
    $specialità = $_POST['specialità'];
}




function isDataValid($username, $password, $eta, $email, $telefono, $classe, $specialità) {
    if($username != null && $password != null && $eta != null && $email != null && $telefono != null && $classe != null && $specialità != null) {
        return true;
    }
    return false;
}

if(isDataValid($username, $password, $eta, $email, $telefono, $classe, $specialità)) {

    $sql = "SELECT username,email FROM utenti WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($sql);
    


    if($result) {
        echo 'Nome o email gia esistente';
        $_SESSION['error'] = 'Nome o email gia esistente';
        // header('Location: ../frontEnd/registrazione.php');

    }



    $hashPassword = hash("sha256", $password);


    // Controllo che la classe esista
    $sql = "SELECT id_classe FROM classe WHERE classe = '$classe' AND specialità = '$specialità'";
    $result = $conn->query($sql);

    


    // Se la classe esiste
    $id_classe = null;
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_classe = $row['id_classe'];
    } else {
        echo 'Classe non trovata o Sezione sbagliata';
        $_SESSION['error'] = 'Classe non trovata o Sezione sbagliata';
     //   header('Location: ../frontEnd/registrazione.php');
    }



    // Inserimento dell'utente
    $sql = "INSERT INTO utente(username, password, eta, email, telefono, id_classe) VALUES ('$username', '$hashPassword', '$eta', '$email', '$telefono', '$id_classe')";
    $result = $conn->query($sql);


    if($result){
        echo 'Registrazione avvenuta con successo';
        $_SESSION['username'] = $username;
     //  header('Location: ../frontEnd/home.php');
  
    } else {
        echo 'Errore durante la registrazione';
        $_SESSION['error'] = 'Errore durante la registrazione';
    //    header('Location: ../frontEnd/registrazione.php');
    }

} else {
    echo 'Non sono stati inseriti tutti i campi';
    $_SESSION['error'] = 'Non sono stati inseriti tutti i campi';

 //   header('Location: ../frontEnd/registrazione.php');
}






?>