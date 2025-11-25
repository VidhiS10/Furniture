<?php
$conn = mysqli_connect("localhost", "root", "", "furniture");

$address_id  = $_POST['address_id'];
$full_name   = $_POST['full_name'];
$phone       = $_POST['phone'];
$house_no    = $_POST['house_no'];
$area        = $_POST['area'];
$landmark    = $_POST['landmark'];
$city        = $_POST['city'];
$state       = $_POST['state'];
$pincode     = $_POST['pincode'];
$address_type = $_POST['address_type'];
$is_default  = $_POST['is_default'];

// If default is selected → remove default from others
if ($is_default == 1) {
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_id FROM tbl_addresses WHERE address_id='$address_id'"));
    $user_id = $user['user_id'];

    mysqli_query($conn, "UPDATE tbl_addresses SET is_default = 0 WHERE user_id = '$user_id'");
}

$query = "UPDATE tbl_addresses SET 
    full_name='$full_name',
    phone='$phone',
    house_no='$house_no',
    area='$area',
    landmark='$landmark',
    city='$city',
    state='$state',
    pincode='$pincode',
    address_type='$address_type',
    is_default='$is_default'
    WHERE address_id='$address_id'";

$res = mysqli_query($conn, $query);

if ($res) {
    echo json_encode(["status"=>true, "message"=>"Address updated successfully"]);
} else {
    echo json_encode(["status"=>false, "message"=>"Update failed"]);
}
?>
