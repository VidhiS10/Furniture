<?php 
$conn=mysqli_connect("localhost","root","","furniture") or die("couldnt connect");


if($_POST['type']==1){
    $id=$_POST['id'];
    $query="delete from tbl_category where cat_id=$id";

    $res=mysqli_query($conn,$query);
    if($query){
        echo "Category Deleted Successfully";
    }else{
        echo "Not Deleted";
    }

}



?>