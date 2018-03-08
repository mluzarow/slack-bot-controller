<?php
http_response_code(200);
header('Content-Type: application/json');
header('Status: 200 OK');

$response = array(
	'status' => true,
	'message' => 'Some message'
);

echo json_encode($response);