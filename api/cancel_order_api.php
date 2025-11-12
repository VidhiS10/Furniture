<?php
$con=mysqli_connect("localhost","root","","furniture");

$id=$_POST['id'];

$query="UPDATE tbl_order SET status=4 where id=$id";
$res=mysqli_query($con,$query);
if($res){

$arr=array("status"=>true,"message"=>"success","order"=>null);

}
echo json_encode($arr);
?>