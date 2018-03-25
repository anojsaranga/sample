<?php
include '../config/config.php';

$user   = new User();

$param  = $_POST['param'];

$retuls = $user->check_user($param);
echo json_encode($retuls);

?>