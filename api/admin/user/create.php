<?php
require_once "../../core/function.php";

$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];


$rs = create_user($email,$password,$role);
var_dump($rs);
die();
$response = array(
    'status' => $rs
);
echo json_encode($response);