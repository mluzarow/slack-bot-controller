<?php
require ('src/TaskSlammer.php');
require ('src/tasks/TestCommand.php');

// function req_auto ($name) {
// 	require ('src/tasks/'.$name.'.php');
// }
// spl_autoload_register ('req_auto');

if (!empty($_POST)) {
	$tasker = new TaskSlammer ($_POST);
} else {
	http_response_code(400);
	header('Content-Type: text/html; charset=UTF-8');
	header('Status: 400 Bad Request');
	echo 'No POST data found.';
}

// http_response_code(200);
// header('Content-Type: application/json');
// header('Status: 200 OK');
// 
// $response = array(
// 	'status' => true,
// 	'message' => 'Some message'
// );
// 
// echo json_encode($response);