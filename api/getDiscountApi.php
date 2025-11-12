<?php
$con=mysqli_connect("localhost","root","","furniture");

$ccode=$_POST['ccode'];
if(isset($ccode)){
$query="select * from tbl_coupen where coupen_code='$ccode'";
$res=mysqli_query($con,$query);

$arr=array("status"=>true,"message"=> "success");
$arr["coupen"]=array();

while($row=mysqli_fetch_assoc($res)){
    array_push($arr["coupen"],$row);
}
echo json_encode($arr);
}
?>