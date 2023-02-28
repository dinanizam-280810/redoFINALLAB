<?php
	
	include_once("dbconnect.php");
	$userid = $_POST['user_id'];
	$hsid = $_POST['hsid'];
	$hsname = addslashes($_POST['hsname']);
	$hsdesc = addslashes($_POST['hsdesc']);
	$hsprice = $_POST['hsprice'];
	
	
	$sqlupdate = "UPDATE `tbl_products` SET `hsname`='$hsname',`hsdesc`='$hsdesc',`hsprice`='$hsprice' WHERE `hsid` = '$hsid' AND `user_id` = '$userid'";
	
	try {
		if ($conn->query($sqlupdate) === TRUE) {
			$response = array('status' => 'success', 'data' => null);
			sendJsonResponse($response);
		}
		else{
			$response = array('status' => 'failed', 'data' => null);
			sendJsonResponse($response);
		}
	}
	catch(Exception $e) {
		$response = array('status' => 'failed', 'data' => null);
		sendJsonResponse($response);
	}
	$conn->close();
	
	function sendJsonResponse($sentArray)
    {
		header('Content-Type = application/json');
		echo json_encode($sentArray);
	}
?>