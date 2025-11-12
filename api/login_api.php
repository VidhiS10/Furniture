<?php
$con=mysqli_connect("localhost","root","","furniture");
if(
    isset($_POST['user_password']) &&
    isset($_POST['user_phone']) 
){
    $user_password=md5($_POST['user_password']);
    $user_phone=$_POST['user_phone'];
    $query="SELECT * from tbl_user where user_phone='$user_phone' and user_password='$user_password'";
    $res=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($res);
    if(isset($row)){
        $arr=array("status"=>true,"message"=>"login..");
        $arr['user']=$row;
        echo json_encode($arr);
    }else{
        $arr=array("status"=>false,"message"=>"Error found in api");
        $arr['user']=null;
        echo json_encode($arr);
    }

}else{
    $arr=array("status"=>false,"message"=>"Insufficient Parameter","user"=>null);
    echo json_encode($arr);
}

?>