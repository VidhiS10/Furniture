<?php
$id=$_GET['id'];

$con = mysqli_connect("localhost", "root", "", "furniture");

$query1="SELECT * FROM tbl_order where id=$id";

$res=mysqli_query($con,$query1);

$row=mysqli_fetch_array($res);

$st=$row['state'];
    


$query="update tbl_order set state=$st+1 where id=$id";
$res=mysqli_query($con,$query);
if($res>0){
    header("location:total_order.php");
}else{
    echo "Not updated";
}
?>