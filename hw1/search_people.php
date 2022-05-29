<?php
session_start();
if(!isset($_SESSION["nomeUtente"]))
{
    header("Location: login.php");
    session_destroy();
    exit;
}
?>

<html>
    <head>
        <script src='search_people.js' defer></script>
        <link rel='stylesheet' href='search_people.css'>
        <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500;800&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <header>
            <h1 id='titolo'>CatGram</h1>
            
        </header>             
        
        <form id = 'ricercaUtente' action = 'do_search_people.php' method = 'POST'>
        <nav>
        <span>
            <input type='text' name='cerca' placeholder = 'Cerca'>
        </span>
        <span>
            <label>&nbsp;<input type='submit' value='Cerca'></label>
        </span>
        <a href= 'home.php'>Ritorna alla home</a>
        </nav>
        </form>
        
        <div id = 'boxUtenti'>
        </div>        
   </body>
</html>