<?php
$con=mysqli_connect("localhost","root","","furniture");

$query="select * from tbl_banner where status=1";
$res=mysqli_query($con,$query);

$arr=array("status"=>true,"message"=>"success");
$arr["banner"]=array();

while($row=mysqli_fetch_assoc($res)){
    array_push($arr["banner"],$row);
}


echo json_encode($arr);
?>