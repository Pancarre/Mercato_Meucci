<?php

include "../backEnd/connessione.php";


$sql = "SELECT id_classe, classe, specialità FROM classe ORDER BY classe";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/registrazione.css">
    <title>Meucci Market</title>
</head>
<body>

    <div class="container-fluid" id="main">
        <div class="row" id="main-row">
            <div id="sub" class="col d-none d-md-flex">
                <div id="sub-main">
                    <h1>Hai già un'account?</h1>
                    <a href="../index.php">
                        <button type="button" class="btn btn-primary">Fai Login</button>
                    </a>
                </div>
            </div>
            <div class="border col" id="main-col">
                <img id="meucci_logo" class="mt-3" src="../img/logo---itis-meucci---firenze.png" alt="logo meucci">
                <h1 class="mt-5">Registrazione</h1>

                <form class="mt-5 mb-5 custom-form" action="../backEnd/scriptregistrazione.php" method="post">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="mb-3 col-6">
                                <input type="text" class="form-control" name="nome" placeholder="Nome" required>
                            </div>
                            <div class="mb-3 col-6">
                                <input type="text" class="form-control" name="cognome" placeholder="Cognome" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    
                    <div class="container-fluid">
                        <div class="row">
                            <div class="mb-3 col-6">
                                <input type="number" class="form-control" name="telefono" placeholder="Telefono" required>
                            </div>
                            <div class="mb-3 col-6">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="number" class="form-control" name="eta" placeholder="Età" required>
                    </div>

                    <div class="container-fluid mb-3">
                        <select class="form-select" name="id_classe" required>
                            <option value="" selected disabled>Seleziona classe</option>
                            <?php
                                while($row = $result->fetch_assoc()){
                                    echo "<option value='" . $row["id_classe"] . "'>" . $row["classe"] . " - " . $row["specialità"] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    
                    <button id="button-login" type="submit" class="btn btn-primary mb-5">Registrati</button>

                    <?php
                        if(isset($_SESSION["errore"])){
                            echo "<br><h3 class='text-danger'>Errore: " . $_SESSION["errore"] . "</h3>";
                        }
                    ?>
                </form>

                <div class="d-block d-md-none">
                    <h1 class="d-inline">Non sei registrato?</h1>
                    <a href="../index.php">
                        <button type="button" class="btn btn-primary">Registrati</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-4hsGdz3T13MQ9GF2mUzGrEF3sf7oFXjLyoeP5B5Woa1Q4yMoFKA6LCeWw5Z3z3Zx" crossorigin="anonymous"></script>
</body>
</html>
