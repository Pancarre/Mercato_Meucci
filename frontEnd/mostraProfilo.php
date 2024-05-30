<?php
include "../backEnd/connessione.php";
include "../backEnd/check_session.php";




if(isset($_GET['id'])){
    $id_utente = $_GET['id'];
} else{

    $username = $_SESSION['username'];

    
    $sql = "SELECT id FROM utente WHERE username = '$username'";
    $result = $conn->query($sql);

    // Assegno l'id dell'utente
    $id_utente = null;
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_utente = $row['id'];
    }

}


$sql = "SELECT username,eta,email,telefono,nome,cognome,immagine_profilo,classe.classe,classe.specialità FROM utente JOIN classe ON utente.id_classe = classe.id_classe WHERE utente.id='$id_utente'";  
$result = $conn->query($sql);


$row = $result->fetch_assoc();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo---itis-meucci---firenze.png" type="image/png">
    <title>Document</title>
</head>
<body>
    <h1>Profilo</h1>

    <?php
        echo "<p>Username: " . $username . "</p>";
        echo "<img src='" . "../" . $row["immagine_profilo"] . "' width='100px' border-radius='50%'>";
        echo "<p>Nome: " . $row["nome"] . "</p>";
        echo "<p>Cognome: " . $row["cognome"] . "</p>";
        echo "<p>Eta: " . $row["eta"] . "</p>";
        echo "<p>Email: " . $row["email"] . "</p>";
        echo "<p>Numero di telefono: " . $row["telefono"] . "</p>";
        echo "<p>Classe: " . $row["classe"] . "</p>";
        echo "<p>Specializzazione: " . $row["specialità"] . "</p>";
    ?>
</body>
</html>