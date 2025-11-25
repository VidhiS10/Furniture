<?php
$conn = mysqli_connect("localhost", "root", "", "furniture");

$address_id = $_POST['address_id'];

$query = "SELECT * FROM tbl_addresses WHERE address_id = '$address_id'";
$res = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($res);

echo json_encode([
    "status" => true,
    "message" => "Single address fetched",
    "addresses" => [$data]   // to match your AddressOutputModel
]);
?>
