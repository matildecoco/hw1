<?php

    // Avvia la sessione
    session_start();
    // Verifica l'accesso
    if(isset($_SESSION["nomeUtente"]))
    {
        // Vai alla home
        header("Location: home.php");
        exit;
    }
    // Verifica l'esistenza di dati POST
    if(isset($_POST["nomeUtente"]) && isset($_POST["password"]))
    {
        // Connetti al database
        $conn = mysqli_connect("localhost", "root", "", "hw1");
        // Cerca utenti con quelle credenziali
        $query = "SELECT * FROM utente WHERE nomeUtente = '".$_POST['nomeUtente']."' AND password = '".$_POST['password']."'";
        $res = mysqli_query($conn, $query);
        // Verifica la correttezza delle credenziali
        if(mysqli_num_rows($res) > 0)
        {
            // Imposta la variabile di sessione
            $_SESSION["nomeUtente"] = $_POST["nomeUtente"];
            // Vai alla pagina home_db.php
            header("Location: home.php");
            exit;
        }
        else
        {
            $errore = true;
        }
    }

?>

<html>
    <head>
        <script src='login.js' defer></script>
        <link rel='stylesheet' href='login.css'>
        <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1 id='titolo'>CatGram</h1>
            
        </header>

        <main>
            <form id = 'login' action = login.php method = 'POST'>
                <div id = 'boxLogin'>
                <h3>Login </h3>
                <p>
                <label>Username <input type='text' name='nomeUtente'></label>
                </p>
                <p>
                <label>Password <input type='password' name='password'></label>
                </p>
                
                <?php
                    if(isset($errore)) {
                        echo "<p class='errore'>";
                        echo "Credenziali errate";
                        echo "</p>";
                    }
                ?>
                
                </div>
                
                <p>
                <label>&nbsp;<input type='submit' value='Accedi'></label>
                </p>
                
                <div id = 'boxRegistrazione'>
                <span> Non sei registrato? </span>
                <a href="signup.php" id='nuovoAccount'> Clicca qui!</a>
                </div>
            
            </form>
        </main>
    </body>
</html>













 
