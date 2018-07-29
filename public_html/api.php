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

// header("Content-Type: text/javascript; charset=utf-8");
header("Content-Type: application/json; charset=utf-8");
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
    echo json_encode($json_array);
    exit;

    case 'events_list':
    if (!isset($_POST['userid'])) {
      throw new \Exception("Error: UserID is not set.");
    }
    $stmt = $_db->prepare("select * from events where id in (select eventid from usr_evt where userid = :userid);");
    $stmt->execute([
      ':userid' => $_POST['userid']
    ]);
    $json_array = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      // fetch potential participants
      $p_par = '';
      $stmt_sub = $_db->prepare("select name from users where id in (select userid from usr_evt where eventid = :eventid);");
      $stmt_sub->execute([
        ':eventid' => $row['id']
      ]);
      while($row_sub = $stmt_sub->fetch(PDO::FETCH_ASSOC)){
        $p_par .= $row_sub['name'];
        $p_par .= ',';
      }
      $p_par = substr($p_par,0,-1);

      // fetch RSVPed participants
      $r_par = '';
      $stmt_sub = $_db->prepare("select name from users where id in (select userid from usr_evt where eventid = :eventid AND rsvp = true);");
      $stmt_sub->execute([
        ':eventid' => $row['id']
      ]);
      while($row_sub = $stmt_sub->fetch(PDO::FETCH_ASSOC)){
        $r_par .= $row_sub['name'];
        $r_par .= ',';
      }
      $r_par = substr($r_par,0,-1);

      // make response
      $json_array[]=array(
        'id'=>$row['id'],
        'name'=>$row['name'],
        'status'=>$row['status'],
        'potential_participants'=>$p_par,
        'RSVPed_participants'=>$r_par,
        'date'=>$row['date'],
        'category'=>$row['category'],
        'description'=>$row['description']
      );
    }
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
