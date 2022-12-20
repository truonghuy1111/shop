<?php
require_once '../../core/function.php';

$order_list = get_order_list();
echo json_encode($order_list);