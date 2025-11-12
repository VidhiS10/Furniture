<?php
$con=mysqli_connect("localhost","root","","furniture");

$id=$_POST['id'];

$query="DELETE from tbl_order where id=$id";
$res=mysqli_query($con,$query);
if($res){

$arr=array("status"=>true,"message"=>"success","order"=>null);

}
echo json_encode($arr);
?>