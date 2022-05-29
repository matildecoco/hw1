<?php

session_start();
if(!isset($_SESSION["nomeUtente"]))
{
    header("Location: login.php");
    session_destroy();
    exit;
}

if(!isset($_POST['cerca'])){
    header("Location: search_people.php");
    exit;
}

$utenti = array();
$conn = mysqli_connect("localhost", "root", "", "hw1");
$query = "SELECT * FROM utente WHERE nomeUtente LIKE '%".$_POST['cerca']."%'";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($res)){
    $utenti[] = $row;
}
mysqli_free_result($res);
mysqli_close($conn);
echo json_encode($utenti);


?>