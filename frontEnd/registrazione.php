<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="./style/registrazione.css">
    <title>Meucci Market</title>
</head>
<body>

    
    <div></div>
    

    <div class="container" >

        <div class="row" id="main">
            <div class="col">




                <img id="meucci_logo" src="./img/logo---itis-meucci---firenze.png" alt="logo meucci">
                <form action="./scriptregistrazione.php" method="post">
                    <h1>Registrazione</h1>
                    <span>Username:</span>
                    <input type="text" placeholder="Username" name="username" required><br>
                    <span>Password:</span>
                    <input type="password" placeholder="Password" name="password" required><br>
                    <span>Età:</span>
                    <input type="number" placeholder="Età" name="eta" required><br>
                    <span>Email:</span>
                    <input type="email" placeholder="Email" name="email" required><br>
                    <span>Telefono:</span>
                    <input type="tel" placeholder="Telefono" name="telefono" required><br>
                    <span>Classe:</span>
                    <input type="text" placeholder="Classe" name="classe" required><br>
                    <span>CAP:</span>
                    <input type="text" placeholder="cap" name="CAP" required><br>
                    <span>Indirizzo:</span>
                    <input type="text" placeholder="indirizzo" name="Indirizzo" required><br>
                    <br>
                    <input type="submit">

                </form>
                <div>
                    <a href="index.html">
                        <span class="material-symbols-outlined">
                        login
                        </span>
                    </a>

                </div>
                


            </div>
        </div>


    </div>

    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>