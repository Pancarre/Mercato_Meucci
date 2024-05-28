<?php
    include("../backEnd/connessione.php");
    include("../backEnd/check_session.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style/home.css" rel="stylesheet">
    <title>Fixed Position Divs with Bootstrap</title>
</head>
<body>

    <div class="fixed-left" id="profilo">
        <img id="logo-meucci" src="../img/logo---itis-meucci---firenze.png" alt="meucci logo">
        <div class="profilo-option">
            <?php
                echo "<p class='mb-0'>User</p><a href=''>" . $_SESSION["username"] . "</a><br>";
            ?>
        </div>

        <a href="./inserisciFile.php" >
            <div class="profilo-option">
                <span>Inserisci file</span>
            </div>
        </a>
        <a href="./storicoAnnunci.php">
            <div class="profilo-option">
                <span>Storico Annunci</span>
            </div>
        </a>
        <a href="./storicoProposte.php">
            <div class="profilo-option">
                <span>Storico delle proposte inviate</span>
            </div>
        </a>
        <a href="../backEnd/logout.php">
            <div class="profilo-option bg-danger">
                <span>Logout</span>
            </div>
        </a>
    </div>

    <div class="fixed-center start-center bg-success" id="toggle">

    </div>

    <div class="main-content main-left">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6 px-0">

                    <h1>Annunci degli altri utenti</h1>
                </div>

                <div class="mt-2 col-12 col-lg-6">
                    <form action="./home.php" method="get">
                        <div class="d-flex" >
                            <select id="filtro" class="form-select" name="categoria">
                                <option value="" selected>Tutte le categorie</option>
                                <option value="1">Telefonia</option>
                                <option value="2">Videogiochi</option>
                                <option value="3">Informatica</option>
                                <option value="4">Libri</option> 
                            </select>
                            <button id="button-login" type="submit" class="btn btn-primary">Filtra</button>
                        </div>
                        
                    </form>
                </div>

                <div class="col-12">

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
                                    echo "<div id='card-container' class='container-fluid col-12 col-sm-6 col-lg-4 float-start mt-4'>";
                                        echo "<div class='card' id='card'>";
                                            echo "<div class='card-header'>".$row["nome"]."</div>";
                                                echo "<div class='card-body'>";
                                                    echo "<div class='container-fluid'>";
                                                        echo "<div class='row'>";
                                                            echo "<div class='col-12 col-md-6'>";
                                                                echo "<a href='./dettagliAnnuncio.php?id=" . $row["id_annuncio"] . "'>";
                                                                echo "<img src='" . $row["image"] . "' class='img-fluid' alt='immagine annuncio'>"; // 'img-fluid' per rendere l'immagine reattiva
                                                                echo "</a>";
                                                            echo "</div>";
                                                            echo "<div class='col-12 col-md-6'>";
                                                                echo "<h5 class='card-title'>" .  $row["data_creazione"] . "</h5>";
                                                                echo "<p>" . $row["stato_di_disponibilità"]  . "</p>";
                                                                echo "<form action='./proposteRicevuteAnnuncio.php' method='get'>";
                                                                echo "<input type='hidden' name='id_annuncio' value='" . $row["id_annuncio"] . "'>";
                                                                echo "<input type='submit' class='btn btn-primary card-btn' value='Visualizza'>"; // Aggiunta di una classe Bootstrap al bottone
                                                                echo "</form>";
                                                            echo "</div>";
                                                        echo "</div>";
                                                    echo "</div>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                    
                                
                                }
                            } else {
                                echo "<p class='text-center mt-5'>Non ci sono annunci da mostrare!</p>";
                            }
                        } 

                    ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="../javascript/home.js"></script>
</body>
</html>
