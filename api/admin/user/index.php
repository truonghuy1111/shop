<?php
require_once '../../core/function.php';

$user_list = get_user_list();
echo json_encode($user_list);