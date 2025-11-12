<?php

$con = mysqli_connect("localhost", "root", "", "furniture");


if(isset($_POST['username']) &&
isset($_POST['pic'] ) &&
isset($_POST['email']) &&
isset($_POST['id'] )

) 
{
    $date = date('m_d_Y_h:i:s_a', time());
    $username=$_POST['username'];
    $email=$_POST['email'];
    $id=$_POST['id'];
    $pic="data:image/octet-stream;base64,".$_POST['pic'];


    // $imgPath='/img/'.$date.".jpg";
    // file_put_contents($imgPath,base64_decode($pic));

    $imgPath=base64_to_image($pic,".jpg");

   
    $query="UPDATE tbl_user SET user_name='$username',user_pic='$imgPath',
    user_email='$email' where user_id=$id ";

$res=mysqli_query($con,$query);

$result=mysqli_query($con,"Select * from tbl_user where user_id=$id");
$row=mysqli_fetch_assoc($result);
if($res){
    $arr=array("status"=>true,"message"=>"Updated Success..");
    $arr['user']=$row;
    echo json_encode($arr);
}else{
    $arr=array("status"=>false,"message"=>"Updated not Success..");
    $arr['user']=null;
    echo json_encode($arr);
}




}else{
    $arr=array("status"=>false,"message"=>"Not Updated..");
    $arr['user']=null;
    echo json_encode($arr);
}



function base64_to_image($base64_string, $type) {


    $data = substr($base64_string, strpos($base64_string, ',') + 1);

    if (!in_array($type, [ '.jpg', '.jpeg', '.gif', '.png' ])) {
        throw new \Exception('invalid image type');
    }

    $data = base64_decode($data);

    if ($data === false) {
        throw new \Exception('base64_decode failed');
    }


    $fullname = "user_".time().$type;

    if(file_put_contents("./img/".$fullname, $data)){
        $result = $fullname;
    }else{
        $result =  "error";
    }

    return $result;
}
?>