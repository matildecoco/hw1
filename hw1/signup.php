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


if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["nomeUtente"]) && isset($_POST["password"]) && isset($_POST["confPassword"]) && isset($_POST["immagine"]) && ($_POST["confPassword"] == $_POST["password"]))
{       
        $conn = mysqli_connect("localhost", "root", "", "hw1");
        $query = "SELECT * FROM utente WHERE nomeUtente = '".$_POST['nomeUtente']."'";
        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res) == 0){
            $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
            $cognome = mysqli_real_escape_string($conn, $_POST["cognome"]);
            $nomeUtente = mysqli_real_escape_string($conn, $_POST["nomeUtente"]);
            $password = mysqli_real_escape_string($conn, $_POST["password"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $immagine = mysqli_real_escape_string($conn, $_POST["immagine"]);
            $inserimento  = "INSERT INTO utente(nomeUtente, nome, cognome, email, password, immagine) VALUES(\"$nomeUtente\", \"$nome\", \"$cognome\",\"$email\",\"$password\",\"$immagine\")";
            mysqli_query($conn, $inserimento);
            $_SESSION["nomeUtente"] = $_POST["nomeUtente"];
            header("Location: home.php");
            mysqli_free_result($res);
            mysqli_close($conn);
        }

        else {
            mysqli_free_result($res);
            mysqli_close($conn);
        }
        
}
 
?>


<html>
    <head>
        <script src='signup.js' defer></script>
        <link rel='stylesheet' href='signup.css'>
        <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1 id='titolo'>CatGram</h1>
           
        </header>
        <main>
            <form id = 'registrazione' action = 'signup.php' method = 'POST'>
                <div id = 'boxSignup'>
                <h3>Registrazione</h3>
                <p>
                <label>Nome <input type='text' name='nome'></label>
                </p>
                <p>
                <label>Cognome <input type='text' name='cognome'></label>
                </p>
                <p>
                <label>E-Mail <input type='text' name='email'></label>
                </p>
                <span id = "ErroreMail"></span>
                <p>
                <label id ='username'>Username <input type='text' name='nomeUtente'></label>
                </p>
                <span id = "ErroreUser"></span>
                <p>
                <label>Password <input type='password' name='password'></label>
                </p>
                <span id = "ErrorePassword"></span>
                <p>
                <label>Conferma password <input type='password' name='confPassword'></label>
                </p>
                <p>
                <label>Immagine del profilo <input type='text' name='immagine'></label>
                </p>

                </div>
                <p>
                <label>&nbsp;<input type='submit' value='Registrati'></label>
                </p>
                <div id = 'boxLogin'>
                <span> Hai già un account? </span>
                <a href="login.php" id='accedi'> Clicca qui!</a>
                </div>
            </form>
            
            
            <span id = "ErroreMail"></span>


            </main>
    </body>
</html>









