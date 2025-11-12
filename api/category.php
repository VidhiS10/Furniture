<?php
$con=mysqli_connect("localhost","root","","furniture");

$query="select * from tbl_category";
$res=mysqli_query($con,$query);

$arr=array("status"=>true,"message"=>"success");
$arr["category"]=array();

while($row=mysqli_fetch_array($res)){
    array_push($arr["category"],$row);
}
echo json_encode($arr);
?>