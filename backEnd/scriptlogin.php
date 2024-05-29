<?php

include "connessione.php";
session_start();

$email = null;
$password = null;


if(isset($_POST["email"]) && isset($_POST["password"])){
    $email = $_POST["email"];
    $password = hash("sha256",$_POST["password"]);
}



if($email != null && $password != null){

    // prendo l'username dell'email
    $sql = "SELECT username FROM utente WHERE email = '$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $username = $row["username"];
    
   // prendo i dati dell'utante username
    $sql = "SELECT * FROM utente WHERE username = '$username'";
    $result = $conn->query($sql);


    // Controllo che l'utente esista
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dbPassword = $row["password"];

        // Controllo che la password sia corretta
        if($password === $dbPassword){
            // Se la password è corretta, faccio il redirect
            $_SESSION["username"] = $username;
            header("Location: ../frontEnd/home.php");
        } else {
            // Se la password non è corretta, faccio il redirect
            $_SESSION["errore"] = "username o password sbagliata";

            header("Location: ../index.php");
        }

    } else {
        // Se l'utente non esiste, faccio il redirect
        $_SESSION["errore"] = "Utente non trovato";

        header("Location: ../index.php");
    }



} else {
    $_SESSION["errore"] = "Compila tutti i campi!!";
    
    header("Location: ../index.php");
}







?>