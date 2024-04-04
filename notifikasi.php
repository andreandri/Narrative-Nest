<?php
$notificationMessage = $_POST['message'];
header('Content-Type: application/json');
echo json_encode(array('message' => $notificationMessage));
?>