<?php
$con=mysqli_connect("localhost","root","","furniture");

$id=$_POST['id'];
$quantity=$_POST['quantity'];
$amount=$_POST['amount'];

$query="UPDATE tbl_order SET quantity=$quantity,total_amount=$quantity*$amount where id=$id";
$res=mysqli_query($con,$query);
if($res){

$arr=array("status"=>true,"message"=>"success","order"=>null);


echo json_encode($arr);

}
?>

