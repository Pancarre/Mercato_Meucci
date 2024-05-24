<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<<<<<<< HEAD
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="./style/login.css">
=======
    <link rel="stylesheet" href="./style/login.css">
    <link rel="stylesheet" href="./javascript/login.js">
>>>>>>> origin/pan
    <title>Meucci Market</title>
</head>
<body>

<<<<<<< HEAD
    

    <div class="container">

        <div class="row" id="main">

            <div class="col">
=======
    <img src="" alt="">

    <div class="container-fluid" id="main">

        <div class="row" id="main-row">

            <div class="border col" id="main-col">
>>>>>>> origin/pan



                <img id="meucci_logo" src="./img/logo---itis-meucci---firenze.png" alt="logo meucci">
<<<<<<< HEAD
                <form action="./backEnd/scriptlogin.php" method="post">
                    <h1>Login</h1>
                    <span>Username</span>
                    <input type="text" placeholder="username" name="username" required><br>
                    <span>Password</span>
                    <input type="password" placeholder="password" name="password" required>
                    <br>
                    <input type="submit">

                </form>

                <div>

                    <a href="./frontEnd/registrazione.php">

                        <span>non sei registrato?</span>
                        <span class="material-symbols-outlined">
                        add
                        </span>

                    </a>
                    
                </div>
=======

                <form class="mt-5 mb-5  custom-form-width" action="./backEnd/scriptlogin.php" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" >
                    </div>
                    <button type="submit" class="btn btn-primary mb-5">Submit</button>

                    <?php

                        session_start();
                        if(isset($_SESSION["errore"])){

                            
                            echo "<br><h3 class='text-danger'>errore: " . $_SESSION["errore"] ."</h3>";


                        }

                    ?>


                </form>

                <div class="mb-5">
                    <span>non sei registrato?</span>
                    <a href="./frontEnd/Registrazione.php">

                    <button type="button" class="btn btn-primary">Registrati</button>

                    
                    
                    </a>

                </div>
                

            </div>

            <div class="col">
>>>>>>> origin/pan

            </div>

            
        </div>



    </div>

    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>