<?php
$conn = mysqli_connect("localhost", "root", "", "furniture");

$user_id = $_POST['user_id'];

$query = "SELECT * FROM tbl_addresses WHERE user_id = '$user_id' ORDER BY is_default DESC";
$res = mysqli_query($conn, $query);

$list = array();
while ($row = mysqli_fetch_assoc($res)) {
    $list[] = $row;
}

echo json_encode([
    "status" => true,
    "message" => "Address list fetched",
    "addresses" => $list
]);
?>
