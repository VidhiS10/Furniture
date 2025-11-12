<?php

$id=$_GET['id'];
$st=$_GET['status'];
//echo $id;

$con=mysqli_connect("localhost","root","","furniture");

$query="update tbl_banner set status=$st where ban_id=$id";
$res=mysqli_query($con,$query);

if($res>0){
    header("location:banner.php");
}else{
    echo "not updated";
}

?>