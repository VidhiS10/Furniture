<?php
$con = mysqli_connect("localhost", "root", "", "furniture");

$uid=$_POST['uid'];
$address=$_POST['address'];
$status=$_POST['status'];


$query="UPDATE tbl_order set status=$status,address='$address' where uid=$uid and status=0";
$res=mysqli_query($con,$query);


$arr=array("status"=>true,"message"=>"success");
$arr["order"]=array();


echo json_encode($arr);

?>