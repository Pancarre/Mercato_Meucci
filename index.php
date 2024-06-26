<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/login.css">
    <link rel="stylesheet" href="./javascript/login.js">
    <link rel="icon" href="./img/logo---itis-meucci---firenze.png" type="image/png">
    <title>Meucci Market</title>
</head>
<body>

    <div class="container-fluid p-0 m-0" id="main">

        <div class="row" id="main-row">

            <div class="border col" id="main-col">



                <img id="meucci_logo" class="mt-3"  src="./img/logo---itis-meucci---firenze.png" alt="logo meucci">

                <h1 class="mt-5">Login</h1>

                <form class="mt-5 mb-5  custom-form" action="./backEnd/scriptlogin.php" method="post">
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="email">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button id="button-login" type="submit" class="btn btn-primary mb-5">Login</button>

                    <?php

                        session_start();
                        if(isset($_SESSION["errore"])){

                            
                            echo "<br><h3 class='text-danger'>errore: " . $_SESSION["errore"] ."</h3>";
                            unset($_SESSION["errore"]);


                        }

                    ?>


                </form>

                <div class="d-block d-md-none">

                    <h1 class="d-inline ">non sei registrato?</h1>
                    <a href="./frontEnd/registrazione.php">

                        <button type="button" class="btn btn-primary">Registrati</button>
                            
                    </a>
                </div>

            </div>

            <div id="sub" class="col d-none d-md-flex">

                <div id="sub-main">

                    <h1>non sei registrato?</h1>
                    <a href="./frontEnd/registrazione.php">

                        <button type="button" class="btn btn-primary">Registrati</button>
                        
                    </a>
                </div>
                
            </div>

            
        </div>



    </div>

    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>