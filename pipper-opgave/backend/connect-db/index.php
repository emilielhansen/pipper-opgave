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
    $statement = $conn->query("select * from pips ORDER BY datetime DESC");
    $result = $statement->fetchAll();

    echo json_encode($result);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
} elseif ($requestType === "POST") {
  try {
      $input = (array) json_decode(file_get_contents('php://input'), TRUE);
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
