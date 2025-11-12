<?php
$con = mysqli_connect("localhost", "root", "", "furniture");



if(isset($_POST['uid'] )
&& isset($_POST['pid'])
&& isset($_POST['pname'])
&& isset($_POST['ppic'])
&& isset($_POST['amount'])
&& isset($_POST['total_amount'])
&& isset($_POST['date'])
&& isset($_POST['time']))
{
    $uid=$_POST['uid'];
    $pid=$_POST['pid'];
    $pname=$_POST['pname'];
    $ppic=$_POST['ppic'];
    $amount=$_POST['amount'];
    $total_amount=$_POST['total_amount'];
    $date=$_POST['date'];
    $time=$_POST['time'];


    $query="INSERT INTO tbl_order ( uid, pid, pname, ppic, date, time, amount, total_amount)
     VALUES ('$uid', '$pid', '$pname', '$ppic', '$date','$time','$amount', '$total_amount')";

$res=mysqli_query($con,$query);
if ($res){
    $last_id = mysqli_insert_id($con);
    $qry= "SELECT * FROM tbl_order WHERE id='$last_id'";
    $r=mysqli_query($con,$qry);

    $row=mysqli_fetch_assoc($r);
    $arr=array("status"=>true,"message"=>"success");
    $arr["order"]=array();

    array_push($arr["order"],$row);
}else{
    $arr=array("status"=>False,"message"=>"Not added to cart");
    $arr['order']=null;
    echo json_encode($arr);
}

}else{
    $arr=array("status"=>false,"message"=>"Insufficient Parameter"
    ,"order"=>null);
}
echo json_encode($arr);

?>