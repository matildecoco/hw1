<?php
session_start();
 
if(!isset($_SESSION["nomeUtente"]))
{ 
    header("Location: login.php");
    exit;
}
?>


 
<html>
    <head>
    <script src='search_content.js' defer></script>
    <link rel='stylesheet' href='create_post.css'>
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500;800&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1 id='titolo'>CatGram</h1>
               
        </header>     
        <form id = 'ricercaPost' action = 'do_search_content.php' method = 'POST'>
            <nav>
                <span>
                    <input type='text' name='cerca' placeholder='Cerca'>
                </span>
        
                <select name='scelta'>
                    <option value="spotify">Cat Songs</option>
                    <option value="giphy">Cat Gifs</option>
                </select>
        
                <span>
                    <label>&nbsp;<input type='submit' value='Cerca'></label>
                </span>
                <a href= 'home.php'>Ritorna alla home</a>
            
            </nav>
        </form>
        
        <section id = 'boxPost'>
        </section>
        <section id="modalView" class="hidden">
        </section>

    </body>
</html>