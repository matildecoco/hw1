<?php

session_start();
if(!isset($_SESSION["nomeUtente"]))
{
    header("Location: login.php");
    session_destroy();
    exit;
}

$seguiti = array();
$conn = mysqli_connect("localhost", "root", "", "hw1");

$query = "SELECT  u.nomeUtente as nomeUtente, u.immagine as Imageuser, p.id as idPost,
        p.titolo as titoloPost, p.Url as ImagePost , p.dataPost as dataPost
        from utente u join follower f join post p on f.seguace = '".$_SESSION['nomeUtente']."'
        and f.seguito=p.nomeUtente and f.seguito = u.nomeUtente and p.nomeUtente = u.nomeUtente or
        (u.nomeUtente='".$_SESSION['nomeUtente']."' and p.nomeUtente= '".$_SESSION['nomeUtente']."') 
        group by(p.id) order by (p.dataPost) DESC";

$res = mysqli_query($conn, $query);


while($row = mysqli_fetch_assoc($res)){
    $seguiti[] = $row;
}
mysqli_free_result($res);
mysqli_close($conn);
echo json_encode($seguiti);

?>


