<?php
$conn = mysqli_connect("localhost", "root", "", "furniture");

$user_id      = $_POST['user_id'] ?? '';
$full_name    = $_POST['full_name'] ?? '';
$phone        = $_POST['phone'] ?? '';
$house_no     = $_POST['house_no'] ?? '';
$area         = $_POST['area'] ?? '';
$landmark     = $_POST['landmark'] ?? '';
$city         = $_POST['city'] ?? '';
$state        = $_POST['state'] ?? '';
$pincode      = $_POST['pincode'] ?? '';
$address_type = $_POST['address_type'] ?? '';
$is_default   = $_POST['is_default'] ?? '0';

// Check missing fields
if (!$user_id || !$full_name || !$phone) {
    echo json_encode(["status"=>false, "message"=>"Missing required fields"]);
    exit;
}

if ($is_default == "1") {
    mysqli_query($conn, "UPDATE tbl_addresses SET is_default = 0 WHERE user_id = '$user_id'");
}

$query = "INSERT INTO tbl_addresses (
    user_id, full_name, phone, house_no, area, landmark, city, state, pincode, 
    address_type, is_default
) VALUES (
    '$user_id', '$full_name', '$phone', '$house_no', '$area', '$landmark',
    '$city', '$state', '$pincode', '$address_type', '$is_default'
)";

$res = mysqli_query($conn, $query);

// Print actual SQL error
if ($res) {
    echo json_encode(["status"=>true, "message"=>"Address added successfully"]);
} else {
    echo json_encode([
        "status"=>false, 
        "message"=>"SQL Error: " . mysqli_error($conn)
    ]);
}
?>
