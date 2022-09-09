<?php

// CONNECT TIL DB
// Inkluder til password i din .env fil
require "./../.env";

// Her connecter du til databasen

// Hvor din database skal køre
$servername = "localhost:3306";

// Dit brugernavn i mySQL
$username = "root";

// Dit password som du henter fra .env filen
$password = getenv('PASSWORD');

// Try-catch så programmet altid kører videre uden at crashe.
// Gør dette først
try {
    // myDB = navnet på din database du vil connecte til
    // De andre feks servernavn, username og password henter serveren længere oppe.
  $conn = new PDO("mysql:host=$servername;dbname=pipper-opgave", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";

  // HENT FRA DB 
  $statement = $conn->query("select * from pips");
  $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

  echo (json_encode($result));

  // HENT NOGET BESTEMT FRA DB 
  //$sql = "select * from pips WHERE username = 'cecilie567'";
  //$statement = $conn->query($sql);
  //$result2 = $statement->fetchAll(\PDO::FETCH_ASSOC);

  //echo (json_encode($result2));
}

// Hvis det ikke virker skal den kører catchen
catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>