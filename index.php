<?php
require ('src/TaskSlammer.php');
// require ('src/tasks/TestCommand.php');

function req_auto ($name) {
	require ('src/tasks/'.$name.'.php');
}
spl_autoload_register ('req_auto');

if (!empty($_POST)) {
	$tasker = new TaskSlammer ($_POST);
}
