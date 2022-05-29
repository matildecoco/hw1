<?php
session_start();
if(!isset($_SESSION["nomeUtente"]))
{
    header("Location: login.php");
    session_destroy();
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "hw1");
$seguace = $_SESSION['nomeUtente'];
$seguito = $_GET['seguito'];
$inserimento  = "INSERT INTO follower(seguace, seguito) VALUES(\"$seguace\", \"$seguito\")";
$res = mysqli_query($conn, $inserimento);
if($res === false){
    echo "0";
    exit;
}
echo "1";

?>