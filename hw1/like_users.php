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
  $query = "SELECT likes.nomeUtente as nomeUtente, likes.postID as postID FROM likes WHERE likes.postID = $post";
  $res = mysqli_query($conn, $query);
  
  if(mysqli_num_rows($res) == 0){
    $utenti[] = [
      'nomeUtente' => 'Nessun like ricevuto',
      'idPost' => $post
    ];
      echo json_encode($utenti);
     
  }
  else {
  while($row = mysqli_fetch_assoc($res))
        {
              $utenti[] = $row;
        }
        
        echo json_encode($utenti);
      }
?>