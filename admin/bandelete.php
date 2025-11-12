<?php 
$conn=mysqli_connect("localhost","root","","furniture") or die("couldnt connect");


if($_POST['type']==1){
    $id=$_POST['id'];
    $query="delete from tbl_banner where ban_id=$id";

    $res=mysqli_query($conn,$query);
    if($query){
        echo "Banner Deleted Successfully";
    }else{
        echo "Not Deleted";
    }

}

?>