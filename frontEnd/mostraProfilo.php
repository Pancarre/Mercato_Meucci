<?php
include "../backEnd/connessione.php";
include "../backEnd/check_session.php";

if(isset($_GET['id'])){
    $id_utente = $_GET['id'];
} else {
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

$sql = "SELECT username, eta, email, telefono, nome, cognome, immagine_profilo, classe.classe, classe.specialità 
        FROM utente 
        JOIN classe ON utente.id_classe = classe.id_classe 
        WHERE utente.id = '$id_utente'";  
$result = $conn->query($sql);

$row = $result->fetch_assoc();

$from_profilo = isset($_GET['from']) && $_GET['from'] === 'profilo';
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
    <div class="container">
   

        <?php
            echo "<h1>Profilo di " . $row["username"] . "</h1>";
            echo "<img src='" . "../" . $row["immagine_profilo"] . "' width='100px' style='border-radius: 50%;'>";
            echo "<h2>Dati personali</h2>";
            echo "<p>Nome: " . $row["nome"] . "</p>";
            echo "<p>Cognome: " . $row["cognome"] . "</p>";
            echo "<p>Età: " . $row["eta"] . "</p>";
            echo "<p>Email: " . $row["email"] . "</p>";
            echo "<p>Numero di telefono: " . $row["telefono"] . "</p>";
            echo "<p>Classe: " . $row["classe"] . "</p>";
            echo "<p>Specializzazione: " . $row["specialità"] . "</p>";
        ?>

        <?php if (!$from_profilo): ?>
            <h1>Annunci attivi</h1>
            <?php
            $sql_annunci = "SELECT * FROM annuncio WHERE id_utente = '$id_utente' AND stato_di_disponibilità = 'Disponibile'";
            $result_annunci = $conn->query($sql_annunci);

            if ($result_annunci) {
                if ($result_annunci->num_rows > 0) {
                    while ($annuncio = $result_annunci->fetch_assoc()) {
                        echo "<img src='" . $annuncio["image"] . "' width='100px' style='border-radius: 50%;'>";
                        echo "<a href='dettagliAnnuncio.php?id=" . $annuncio["id_annuncio"] . "'>" . $annuncio["nome"] . "</a><br>";
                        echo "<p>Creato: " . $annuncio["data_creazione"] . "</p>";
                    }
                } else {
                    echo "<p>Non ci sono annunci attivi.</p>";
                }
            } else {
                echo "<p>Errore nella query degli annunci: " . $conn->error . "</p>";
            }
            ?>
        <?php endif; ?>
    </div>
</body>
</html>
