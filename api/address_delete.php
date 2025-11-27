<?php
$conn = mysqli_connect("localhost", "root", "", "furniture");

$id = $_POST['id'];

$query = "DELETE FROM tbl_addresses WHERE id = '$id'";
$res = mysqli_query($conn, $query);

if ($res) {
    echo json_encode(["status"=>true, "message"=>"Address deleted successfully"]);
} else {
    echo json_encode(["status"=>false, "message"=>"Delete failed"]);
}
?>
