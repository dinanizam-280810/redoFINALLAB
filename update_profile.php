<?php
      if (!isset($_POST)) {
      $response = array('status' => 'failed', 'data' => null);
      sendJsonResponse($response);
      die();
     }

if (isset($_POST['image'])) {
    $encoded_string = $_POST['image'];
    $userid = $_POST['userid'];
    $decoded_string = base64_decode($encoded_string);
    $path = 'C:/Users/acer/xampp/htdocs/homestayraya/mobile/assets/profileimages' . $userid . '.png';
    $is_written = file_put_contents($path, $decoded_string);
    if ($is_written){
        $response = array('status' => 'success', 'data' => null);
        sendJsonResponse($response);
    }else{
        $response = array('status' => 'failed', 'data' => null);
        sendJsonResponse($response);
    }
    die();
}
if (isset($_POST['newphone'])) {
    $phone = $_POST['newphone'];
    $userid = $_POST['user_id'];
    $sqlupdate = "UPDATE tbl_users SET user_phone ='$phone' WHERE user_id ='$userid'";
    databaseUpdate($sqlupdate);
    die();
}
if (isset($_POST['oldpassword'])) {
    $oldpassword= sha1($_POST['oldpassword']);
    $newpassword= sha1($_POST['newpassword']);
    $userid = $_POST['user_id'];
    include_once("dbconnect.php");
    $sqllogin = "SELECT * FROM tbl_users WHERE user_id = '$userid' AND user_password = '$oldpass'";
    $result = $conn->query($sqllogin);
    if ($result->num_rows > 0) {
    $sqlupdate = "UPDATE tbl_users SET user_password ='$password' WHERE user_id = '$userid'";
    if ($conn->query($sqlupdate) === TRUE) {
        $response = array('status' => 'success', 'data' => null);
        sendJsonResponse($response);
    } else {
        $response = array('status' => 'failed', 'data' => null);
        sendJsonResponse($response);
    }
}else{
     $response = array('status' => 'failed', 'data' => null);
     sendJsonResponse($response);
     }
}
if (isset($_POST['newname'])) {
    $name = $_POST['newname'];
    $userid = $_POST['user_id'];
    $sqlupdate = "UPDATE tbl_users SET user_name ='$name' WHERE user_id = '$userid'";
    databaseUpdate($sqlupdate);
    die();
}

function databaseUpdate($sql){
    include_once("dbconnect.php");
    if ($conn->query($sql) === TRUE) {
        $response = array('status' => 'success', 'data' => null);
        sendJsonResponse($response);
    } else {
        $response = array('status' => 'failed', 'data' => null);
        sendJsonResponse($response);
    }
}
function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>
