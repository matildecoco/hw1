<?php
session_start();
if(!isset($_SESSION["nomeUtente"]))
{
    header("Location: login.php");
    session_destroy();
    exit;
}


  $utenti = array();
  $post= $_GET['idPost'];
  $conn = mysqli_connect("localhost", "root", "", "hw1") or die("Errore: ".mysqli_connect_error());
  $query = "INSERT INTO likes values ('".$_GET['idPost']."', '".$_SESSION["nomeUtente"]."')";
  $res = mysqli_query($conn, $query);
  $query2 = "SELECT count(l.postID) as numeroLikes , p.id as idPost from post p
   JOIN likes l on postID = '".$_GET['idPost']."' and l.postID = p.id  group by(p.id)";
  $res2 = mysqli_query($conn, $query2);
  if(mysqli_num_rows($res2) == 0){
    $utenti[] = [
      'numeroLikes' => '0',
      'idPost' => $post
    ];
      echo json_encode($utenti);
  }
  else {
  while($row = mysqli_fetch_assoc($res2))
        {
              $utenti[] = $row;
        }
        echo json_encode($utenti);
      }
?>