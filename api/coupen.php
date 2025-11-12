<?php
$con=mysqli_connect("localhost","root","","furniture");

$query="select * from tbl_coupen";
$res=mysqli_query($con,$query);

$arr=array("status"=>true,"message"=>"success");
$arr["coupen"]=array();

while($row=mysqli_fetch_assoc($res)){
    array_push($arr["coupen"],$row);
}


echo json_encode($arr);
?>