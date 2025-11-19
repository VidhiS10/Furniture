<?php $con = mysqli_connect("localhost","root","","furniture"); 
$name = $_POST['name']; 
$email = $_POST['email']; 
$id = $_POST['user_id']; 
$sql = "UPDATE users SET name='$name', email='$email' WHERE id='$id'"; 
if(mysqli_query($con, $sql))
    {
        echo json_encode(["success"=>true]); 
    } 
    else 
    {
        echo json_encode(["success"=>false]); 
    } 
?>