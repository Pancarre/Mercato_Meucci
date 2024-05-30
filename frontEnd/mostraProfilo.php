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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/mostraProfilo.css">
    <title>Document</title>
</head>
<body>



<nav class="navbar navbar-expand-lg fixed-top blue" >
        <div class="container-fluid">
        <a class="btn btn-primary border blue me-2" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
            <span class="material-symbols-outlined pt-1">
                menu
            </span>
        </a>
          <a class="navbar-brand text-light" href="./home.php">
            <img src="../img/logo---itis-meucci---firenze.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                Profilo Utente
          </a>


            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">

            
              </li>
            </ul>

        </div>
      </nav>

      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body blue" id="profilo">
          <div class="profilo-option">
              <?php
                  echo "<p class='mb-0'>User</p><a href='./mostraProfilo.php?from=profilo'>" . $_SESSION["username"] . "</a><br>";
              ?>
          </div>

          <a href="./home.php">
              <div class="profilo-option">
                  <span>Home</span>
              </div>
          </a>

          <a href="./inserisciFile.php" >
              <div class="profilo-option">
                  <span>Inserisci Annuncio</span>
              </div>
          </a>
          <a href="./storicoAnnunci.php">
              <div class="profilo-option">
                  <span>Storico Annunci</span>
              </div>
          </a>

          <a href="../backEnd/logout.php">
              <div class="profilo-option bg-danger">
                  <span>Logout</span>
              </div>
          </a>
        </div>
      </div>








    <div class="container-fluid d-flex justify-content-center  " id="main">
   
        <div class="col-2 d-none d-md-flex"></div>

        <div class="col-12 col-sm-8 border border-dark">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ps-5 border-dark border-bottom">

        <?php
            echo "<h1>Profilo di " . $row["username"] . "</h1>";
            echo "</div>";
            echo "<div class='col-12 col-lg-6 border-dark border-bottom' id='image-div'>";
            echo "<img id='profile-img' src='" . "../" . $row["immagine_profilo"] . "'style='border-radius: 50%;'>";
            echo "</div>";
            echo "<div class='col-12 col-lg-6 text-center border-dark border-bottom'>";
            echo "<h2>Dati personali</h2>";
            echo "<table class='table table-sm'><tr><th>Nome:</th><th>Cognome:</th></tr><tr><td>" . $row["nome"] . "</td>";
            echo "<td>" . $row["cognome"] . "</td></tr></table>";
            echo "<table class='table table-sm'><tr><th>Età:</th><td> " . $row["eta"] . "</td></tr></table>";
            echo "<table class='table table-sm'><tr><th>Email:</th><th>Numero di telefono:</th></tr><tr><td>" . $row["email"] . "</td>";
            echo "<td> " . $row["telefono"] . "</td></tr></table>";
            echo "<table class='table table-sm'><tr><th>Sezione:</th><th>Specialità:</th></tr><tr><td> " . $row["classe"] . "</td>";
            echo "<td>" . $row["specialità"] . "</td></tr></table>";
        ?>
                    </div>
                </div>
            </div>
            



        <?php if (!$from_profilo): ?>
            <h1 class="text-center">Annunci attivi</h1>
            <?php
            $sql_annunci = "SELECT * FROM annuncio WHERE id_utente = '$id_utente' AND stato_di_disponibilità = 'Disponibile'";
            $result_annunci = $conn->query($sql_annunci);

            if ($result_annunci) {
                if ($result_annunci->num_rows > 0) {
                    while ($annuncio = $result_annunci->fetch_assoc()) {
                        echo "<div class='container-fluid col-12 col-md-6 float-start mt-4'>";
                            echo "<div class='card' id='card'>";
                                echo "<div class='card-header text-center'><h2 class='fitted-text pt-2'>".$annuncio["nome"]."</h2></div>";
                                    echo "<div class='card-body'>";
                                        echo "<div class='container-fluid d-flex justify-content-center align-items-center'>";
                                            echo "<div class='row'>";

                                                echo "<div class='col-6'>";
                                                    echo "<a href='./dettagliAnnuncio.php?id=" . $annuncio["id_annuncio"] . "&from=storico'>";
                                                    echo "<img src='" . $annuncio["image"] . "' class='img-fluid' alt='immagine annuncio' width='75px'>"; // 'img-fluid' per rendere l'immagine reattiva
                                                    echo "</a>";
                                                echo "</div>";
                                                echo "<div class='col-6'>";
                                                echo "<p>Creato: " . $annuncio["data_creazione"] . "</p>";   
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                            echo "</div>";
                        echo "</div>";

                
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
           
        <div class="col-2 d-none d-md-block"></div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
