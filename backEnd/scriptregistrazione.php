<?php

include 'connessione.php';

session_start();

$username = null;
$password = null;
$eta = null;
$email = null;
$telefono = null;
$classe = null;
$indirizzo = null;
$cap = null;


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
if(isset($_POST['indirizzo'])) {
    $indirizzo = $_POST['indirizzo'];
}
if(isset($_POST['cap'])) {
    $cap = $_POST['cap'];
}


function isDataValid($username, $password, $eta, $email, $telefono, $classe, $indirizzo, $cap) {

    if($username != null && $password != null && $eta != null && $email != null && $telefono != null && $classe != null && $indirizzo != null && $cap != null) {
        return true;
    }

    return false;
}

if(isDataValid($username, $password, $eta, $email, $telefono, $classe, $indirizzo, $cap)) {

    $sql = "SELECT username,email FROM utenti WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($sql);
    


    if($result) {
        echo 'Nome o email gia esistente';
        $_SESSION['error'] = 'Nome o email gia esistente';
    //    header('Location: ../registrazione.php');

    }



    $hashPassword = hash("sha256", $password);

    //TO DO: GESTIRE ID CLASSE, invece di 5C devo mettere il suo id

    $sql = "INSERT INTO utente(username, password, eta, email, telefono, classe, cap) VALUES ('$username', '$hashPassword', '$eta', '$email', '$telefono', '$classe',  '$cap')";
    $result = $conn->query($sql);


    if($result){
        echo 'Registrazione avvenuta con successo';
        $_SESSION['username'] = $username;
     //   header('Location: ../frontEnd/home.php');
  
    } else {
        echo 'Errore durante la registrazione';
        $_SESSION['error'] = 'Errore durante la registrazione';
     //   header('Location: ../registrazione.php');
    }

} else {
    echo 'Non sono stati inseriti tutti i campi';
    $_SESSION['error'] = 'Non sono stati inseriti tutti i campi';
  //  header('Location: ../registrazione.php');
}






?>