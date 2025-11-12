<?php

$con = mysqli_connect("localhost", "root", "", "furniture");

if (isset($_POST['user_phone'])) {

    $user_phone = $_POST['user_phone'];

    $query = "SELECT * FROM tbl_user WHERE user_phone='$user_phone' LIMIT 1";
    $res = mysqli_query($con, $query);

    if (mysqli_num_rows($res) > 0) {
        
        $row = mysqli_fetch_assoc($res);
        $arr = array("status" => true, "message" => "User Found!");
        $arr['user'] = $row;

        echo json_encode($arr);

    } else {
        $arr = array("status" => false, "message" => "User Not Found", "user" => null);
        echo json_encode($arr);
    }

} else {
    $arr = array("status" => false, "message" => "Phone Number Missing", "user" => null);
    echo json_encode($arr);
}

?>
