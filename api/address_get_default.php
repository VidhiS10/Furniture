<?php
$conn = mysqli_connect("localhost", "root", "", "furniture");

$user_id = $_POST['user_id'] ?? '';

if (!$user_id) {
    echo json_encode(["status"=>false, "message"=>"User ID missing"]);
    exit;
}

$q = "SELECT * FROM tbl_addresses WHERE user_id='$user_id' ORDER BY is_default DESC LIMIT 1";
$res = mysqli_query($conn, $q);

$data = [];

while ($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
}

echo json_encode([
    "status" => count($data) > 0,
    "message" => count($data) > 0 ? "Address found" : "No address found",
    "addresses" => $data
]);
?>
