<?php
$conn = mysqli_connect("localhost", "root", "", "furniture");

$id = $_POST['id'];

$query = "SELECT * FROM tbl_addresses WHERE id = '$id'";
$res = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($res);

echo json_encode([
    "status" => true,
    "message" => "Single address fetched",
    "addresses" => [$data]   // to match your AddressOutputModel
]);
?>
