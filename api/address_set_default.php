<?php
$conn = mysqli_connect("localhost", "root", "", "furniture");

$user_id    = $_POST['user_id'];
$address_id = $_POST['address_id'];

// Remove old default
mysqli_query($conn, "UPDATE tbl_addresses SET is_default = 0 WHERE user_id = '$user_id'");

// Set new default
mysqli_query($conn, "UPDATE tbl_addresses SET is_default = 1 WHERE address_id = '$address_id'");

echo json_encode(["status"=>true, "message"=>"Default address updated"]);
?>
