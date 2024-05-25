<?php
include "../backEnd/connessione.php";
include "../backEnd/check_session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/login.css">
    <title>Meucci Market</title>
</head>
<body>

    <?php
        echo "Sei entrato come: " . $_SESSION["username"] . "<br><br>";    
    ?>

    <a href="../backEnd/logout.php">Logout</a><br>
    <a href="./inserisciFile.php">Inserisci file</a><br>
    <a href="./storicoAnnunci.php">Storico Annunci</a><br>
    <a href="./storicoProposte.php">Storico delle proposte inviate</a>
    <h1>Annunci degli altri utenti</h1>
 
    <div class="mb-3 col-6">
        <form action="./home.php" method="get">
            <select class="form-select" name="categoria">
                <option value="" selected>Tutte le categorie</option>
                <option value="1">Telefonia</option>
                <option value="2">Videogiochi</option>
                <option value="3">Informatica</option>
                <option value="4">Libri</option>
            </select>
            <button id="button-login" type="submit" class="btn btn-primary mb-5">Filtra</button>
        </form>
    </div>

    <?php

        


        // Prendo l'id dell'utente loggato
        $username = $_SESSION["username"];
        $sql = "SELECT id FROM utente WHERE username = '$username'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row["id"];
            $categoria_id = isset($_GET['categoria']) ? $_GET['categoria'] : '';

            // Seleziona gli annunci che gli utenti hanno pubblicato ad eccezione di quelli di $id
            $sql = "SELECT annuncio.*, utente.username FROM annuncio JOIN utente ON annuncio.id_utente = utente.id WHERE annuncio.id_utente != '$id'";
            
            if (!empty($categoria_id)) {
                $sql .= " AND annuncio.id_categoria = '$categoria_id'";
            }

            $result = $conn->query($sql);

            // Mostra tutti gli annunci
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div>";
                    echo "<a href='./dettagliAnnuncio.php?id=" . $row["id_annuncio"] . "'>";
                    echo "<img src='" . $row["image"] . "' width='100px'>";
                    echo "<p>" . $row["nome"] . "</p>";
                    echo "<p>" . $row["username"] . "</p>";
                    echo "</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>Non ci sono annunci da mostrare!</p>";
            }
        } 

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>