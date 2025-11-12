<?php
include('include.php');
$con = mysqli_connect("localhost","root","","furniture");

if(isset($_POST['Submit'])){
    $admin_name=$_POST['admin_name'];
    $admin_email=$_POST['admin_email'];
    $admin_mobile=$_POST['admin_mobile'];
    
    $id=$_SESSION['admin_id'];

   $query="update tbl_admin SET admin_name='$admin_name',admin_email=
   '$admin_email',admin_mobile='$admin_mobile' where admin_id=$id";

    $res=mysqli_query($con,$query);

    if($res){
        echo "Updated Successfully!!!";
        echo "<script type='text/javascript'>
        window.location.href='profile.php';
        </script>";
        $_SESSION["admin_name"]=$admin_name;
        $_SESSION["admin_email"]=$admin_email;
        $_SESSION["admin_mobile"]=$admin_mobile;
    }else{

    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="profile.css" rel="stylesheet">
</head>
<body>
    

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">


    <div class="text-center display-6 my-2 text-dark">
    <b>Welcome <?php  
    echo $_SESSION["admin_name"];
    ?></b>
    </div>
    
    </div>

    
        </div>
        <form method="POST" class="col-md-9 border-right">
            <div class="py-5">

<!-- slider -->

<div class="d-flex justify-content-between align-items-center mb-3">
        <ul class="nav nav-underline">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile_edit.php">Edit Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="change_password.php">Change Password</a>
            </li>
        </ul>
    </div>
    
<!-- slider -->

                <hr id="hr" style="border:1px solid black">


                <div class="row mt-5">
                    <div class="col-md-12"><label class="col-md-12">Name :<input type="text" name="admin_name" class="form-control" placeholder="first name" value="<?php  echo $_SESSION["admin_name"];?>"></label></div>
                    <div class="col-md-12"><label class="col-md-12">Email ID :<input type="text" name="admin_email" class="form-control" placeholder="enter email id" value="<?php  echo $_SESSION["admin_email"];?>"></label></div>
                    <div class="col-md-12"><label class="col-md-12">Mobile Number :<input type="text" name="admin_mobile" class="form-control" placeholder="enter phone number" value="<?php  echo $_SESSION["admin_mobile"];?>"></label></div>
                </div>
                
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="submit" name="Submit">Save Profile</button></div>
            </div>
</form>
    </div>
</div>
</div>
<?php
include('footer.php');
?>
</div>
</body>
</html>
    


