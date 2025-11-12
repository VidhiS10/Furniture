<?php
$con=mysqli_connect("localhost","root","","furniture");

$query="select * from tbl_order";
$res=mysqli_query($con,$query);

$arr=array("status"=>true,"message"=>"success");
$arr["order"]=array();

while($row=mysqli_fetch_assoc($res)){
    array_push($arr["order"],$row);
}


echo json_encode($arr);
?>