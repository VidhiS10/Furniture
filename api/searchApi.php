<?php
$con=mysqli_connect("localhost","root","","furniture");

$search=$_POST['search'];

$query="SELECT * FROM tbl_sub_category WHERE sub_cat_name LIKE '%$search%'";  
$res=mysqli_query($con,$query);

$arr=array("status"=>true,"message"=>"success");
$arr["sub_category"]=array();

while($row=mysqli_fetch_assoc($res)){
    array_push($arr["sub_category"],$row);
}

echo json_encode($arr);
?>