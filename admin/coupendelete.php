<?php 
$conn=mysqli_connect("localhost","root","","furniture") or die("couldnt connect");


if($_POST['type']==1){
    $id=$_POST['id'];
    $query="delete from tbl_coupen where coupen_id=$id";

    $res=mysqli_query($conn,$query);
    if($query){
        echo "coupen Deleted Successfully";
    }else{
        echo "Not Deleted";
    }

}

?>