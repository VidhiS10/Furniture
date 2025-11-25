<?php
$conn = mysqli_connect("localhost", "root", "", "furniture");

$address_id = $_POST['address_id'];

$query = "DELETE FROM tbl_addresses WHERE address_id = '$address_id'";
$res = mysqli_query($conn, $query);

if ($res) {
    echo json_encode(["status"=>true, "message"=>"Address deleted successfully"]);
} else {
    echo json_encode(["status"=>false, "message"=>"Delete failed"]);
}
?>
