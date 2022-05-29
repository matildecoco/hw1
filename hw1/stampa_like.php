<?php
  $utenti = array();
  $post= $_GET['idPost'];
  $conn = mysqli_connect("localhost", "root", "", "hw1") or die("Errore: ".mysqli_connect_error());
  $query = "SELECT count(l.postID) as numeroLikes , p.id as idPost from post p
   JOIN likes l on postID = '".$_GET['idPost']."' and l.postID = p.id  group by(p.id)";
  $res = mysqli_query($conn, $query);
  if(mysqli_num_rows($res) == 0){
    $utenti[] = [
      'numeroLikes' => '0',
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