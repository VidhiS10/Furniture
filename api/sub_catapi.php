<?php
$con=mysqli_connect("localhost","root","","furniture");


$query="select * from tbl_sub_category";
$res=mysqli_query($con,$query);

$arr=array("status"=>true,"message"=>"success");
$arr["sub_category"]=array();

while($row=mysqli_fetch_assoc($res)){
    array_push($arr["sub_category"],$row);
}

echo json_encode($arr);
?>