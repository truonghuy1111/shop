<?php
require_once "../../core/function.php";

$id = $_GET['id'];

$product = get_user($id);

$response = array(
    'status' => 200,
    'data' => $product
);
echo json_encode($response);