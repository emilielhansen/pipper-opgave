<?php

// CONNECT TIL DB
// Inkluder til password i din .env fil
require "./../.env";


header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8"); 
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE"); 
header("Access-Control-Max-Age: 3600"); 
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 


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



DET VIRKER NÆSTEN

<?php

// CONNECT TIL DB
// Inkluder til password i din .env fil

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials : true");


// Her connecter du til databasen

// Hvor din database skal køre
$servername = "localhost:3306";

// Dit brugernavn i mySQL
$username = "root";

// Dit password som du henter fra .env filen
$password = 'Bella1234';

$requestType = $_SERVER["REQUEST_METHOD"];

if ($requestType === "GET") {
  try {
    $conn = new PDO("mysql:host=$servername;dbname=pipper-opgave", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $conn->query("select * from pips");
    $result = $statement->fetchAll();

    echo json_encode($result);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
} elseif ($requestType === "POST") {
  try {
      $statement = 
      "
      INSERT INTO pips 
            (username, pipmessage) 
            VALUES
            (:username, :pip);
      ";

    $conn = new PDO("mysql:host=$servername;dbname=pipper-opgave", $username, $password);
    $statement = $conn->prepare($statement);
    $statement->execute(array(
      'pipmessage' => $input['pip'],
      'username' => $input['username'],
    ));

    $id = $conn->lastInsertId();
    $pip = (object) $input;
    $pip->id = $id;

    $response['status_code_header'] = 'HTTP/1.1 201 Created';
    $response['body'] = json_encode($pip);
    return $response;
    
  } 
  catch (\PDOException $e) {
    exit($e->getMessage());
  }
}
