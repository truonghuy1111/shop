<?php
require_once "../../core/function.php";

$id = $_POST['id'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];


$rs = update_user($id,$email,$password,$role);

$response = array(
    'status' => $rs
);
echo json_encode($response);