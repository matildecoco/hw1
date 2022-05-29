
<?php

      // Connessione al database
      $conn = mysqli_connect("localhost", "root", "", "hw1");
      // Inizializza array di eventi
      $utenti = array();
      // Leggi eventi
      $res = mysqli_query($conn, "SELECT * FROM utente");
      while($row = mysqli_fetch_assoc($res))
      {
            $utenti[] = $row;
      }
      // Chiudi
      mysqli_free_result($res);
      mysqli_close($conn);
      // Ritorna
      echo json_encode($utenti);

?>