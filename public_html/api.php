<?php
require_once(__DIR__ . '/../config/dbconfig.php');

// Connect to DB
try {
  $_db = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);
  $_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
  echo $e->getMessage();
  exit;
}

header("Content-Type: text/javascript; charset=utf-8");
header("Access-Control-Allow-Origin: *");

// Process Request
try{
  if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    throw new \Exception("Error: Request method is wrong.");
  }
  if (!isset($_POST['API_name'])) {
    throw new \Exception("Error: API name is not set.");
  }
  switch ($_POST['API_name']) {
    case 'valid_user_list':
    $stmt = $_db->prepare("select id,name from users");
    $stmt->execute();
    $json_array = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $json_array[]=array(
        'id'=>$row['id'],
        'name'=>$row['name']
      );
    }
    // header("Content-Type: text/javascript; charset=utf-8");
    // header("Access-Control-Allow-Origin: *");
    // header("Access-Control-Allow-Headers: *");
    // header("Access-Control-Allow-Methods: *");
    // header("Content-Type: text/javascript; charset=utf-8; Access-Control-Allow-Origin: *");
    echo json_encode($json_array);
    exit;

    case 'events_list':
    $stmt = $_db->prepare("select * from events");
    $stmt->execute();
    $json_array = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $json_array[]=array(
        'id'=>$row['id'],
        'name'=>$row['name'],
        'status'=>$row['status'],
        'potential_participants'=>'dummy',
        'RSVPed_participants'=>'dummy',
        'date'=>$row['date'],
        'category'=>$row['category'],
        'description'=>$row['description']
      );
    }
    // header("Content-Type: text/javascript; charset=utf-8");
    // header("Access-Control-Allow-Origin: *");
    // header("Access-Control-Allow-Headers: Content-Type");
    // header("Content-Type: text/javascript; charset=utf-8; Access-Control-Allow-Origin: *");
    echo json_encode($json_array);
    exit;

    case 'user_info':
    if (!isset($_POST['userid'])) {
      throw new \Exception("Error: UserID is not set.");
    }
    $stmt = $_db->prepare("select * from users where id = :userid");
    $stmt->execute([
      ':userid' => $_POST['userid']
    ]);
    $json_array = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $json_array[]=array(
        'id'=>$row['id'],
        'name'=>$row['name'],
        'department'=>$row['department'],
        'years'=>$row['years'],
        'personality'=>$row['personality'],
        'reward'=>$row['reward']
      );
    }
    // header("Content-Type: text/javascript; charset=utf-8");
    // header("Access-Control-Allow-Origin: *");
    // header("Access-Control-Allow-Headers: Content-Type");
    // header("Content-Type: text/javascript; charset=utf-8; Access-Control-Allow-Origin: *");
    echo json_encode($json_array);
    exit;

    case 'RSVP':
    if (!isset($_POST['userid'])) {
      throw new \Exception("Error: UserID is not set.");
    }
    if (!isset($_POST['eventid'])) {
      throw new \Exception("Error: EventID is not set.");
    }
    $stmt = $_db->prepare("update usr_evt set rsvp = true where userid = :userid AND eventid = :eventid");
    $json_array = $stmt->execute([
      ':userid' => $_POST['userid'],
      ':eventid' => $_POST['eventid']
    ]);
    if ($json_array == true){
      if ($stmt->rowCount() == 0){
        throw new \Exception("Error: UserID or EventID is wrong.");
      }else{
        $json_array = 0;
      }
    }
    // header("Content-Type: text/javascript; charset=utf-8");
    // header("Access-Control-Allow-Origin: *");
    // header("Access-Control-Allow-Headers: Content-Type");
    // header("Content-Type: text/javascript; charset=utf-8; Access-Control-Allow-Origin: *");
    echo json_encode($json_array);
    exit;

    default:
    throw new \Exception("Error: API name is wrong.");
  }
} catch (Exception $e){
  header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
  echo $e->getMessage();
  exit;
}

?>
