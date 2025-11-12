<?php
$con=mysqli_connect("localhost","root","","furniture");
$cid=$_POST['cid'];

$query="select * from tbl_sub_category where cat_id=$cid";
$res=mysqli_query($con,$query);

$arr=array("status"=>true,"message"=>"success");
$arr["sub_category"]=array();

while($row=mysqli_fetch_assoc($res)){
    array_push($arr["sub_category"],$row);
}

echo json_encode($arr);
?>