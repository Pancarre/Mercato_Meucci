<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="./style/login.css">
    <title>Meucci Market</title>
</head>
<body>

    

    <div class="container">

        <div class="row" id="main">

            <div class="col">



                <img id="meucci_logo" src="./img/logo---itis-meucci---firenze.png" alt="logo meucci">
                <form action="scriptlogin.php" method="post">
                    <h1>Login</h1>
                    <span>Username</span>
                    <input type="text" placeholder="username" name="username" required><br>
                    <span>Password</span>
                    <input type="password" placeholder="password" name="password" required>
                    <br>
                    <input type="submit">

                </form>

                <div>

                    <a href="Registrazione.html">

                        <span>non sei registrato?</span>
                        <span class="material-symbols-outlined">
                        add
                        </span>

                    </a>
                    
                </div>

            </div>

            
        </div>



    </div>

    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>