<?php

include 'connessione.php';
session_start();

$username = null;
$password = null;
$datanascita = null;
$email = null;
$telefono = null;
$id_classe = null;
$nome = null;
$cognome = null;



if(isset($_POST['username'])) {
    $username = $_POST['username'];
}
if(isset($_POST['password'])) {
    $password = $_POST['password'];
}
if(isset($_POST['datanascita'])) {
    $datanascita = $_POST['datanascita'];
}
if(isset($_POST['email'])) {
    $email = $_POST['email'];
}
if(isset($_POST['telefono'])) {
    $telefono = $_POST['telefono'];
}
if(isset($_POST['id_classe'])) {
    $id_classe = $_POST['id_classe'];
}
if(isset($_POST['nome'])) {
    $nome = $_POST['nome'];
}
if(isset($_POST['cognome'])) {
    $cognome = $_POST['cognome'];
}



function isDataValid($username, $password, $datanascita, $email, $telefono, $id_classe, $nome, $cognome) {
    if($username != null && $password != null && $datanascita != null && $email != null && $telefono != null && $id_classe != null  && $nome != null && $cognome != null) {
        return true;
    }
    return false;
}

if(isDataValid($username, $password, $datanascita, $email, $telefono, $id_classe, $nome, $cognome)) {

    $sql = "SELECT username,email FROM utenti WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($sql);
    


    if($result && $result->num_rows > 0) {


        $_SESSION['errore'] = 'username o email gia esistente';
       header('Location: ../frontEnd/registrazione.php');

    }



    $hashPassword = hash("sha256", $password);

    if($id_classe == ""){

        $_SESSION['errore'] = 'Seleziona una classe';
        header('Location: ../frontEnd/registrazione.php');
    } 


    // Inserimento dell'utente
    $sql = "INSERT INTO utente(username, password, datanascita, email, telefono, id_classe, nome, cognome) VALUES ('$username', '$hashPassword', '$datanascita', '$email', '$telefono', '$id_classe', '$nome', '$cognome')";
    $result = $conn->query($sql);


    if($result){
    
    $_SESSION['username'] = $username;
       header('Location: ../index.php');
  
    } else {

        $_SESSION['errore'] = 'Errore durante la registrazione';
        header('Location: ../frontEnd/registrazione.php');
    }

} else {

    $_SESSION['errore'] = 'Non sono stati inseriti tutti i campi';
    header('Location: ../frontEnd/registrazione.php');
}






?>