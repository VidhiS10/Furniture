<?php
$con = mysqli_connect("localhost", "root", "", "furniture");

if(isset($_POST['submit'])){
    $email=$_GET['email'];
    $pwd=$_POST['pwd'];
    $cpwd=$_POST['cpwd'];

    if(!isset($pwd) && !isset($cpwd)){
        echo "<script>alert('Please fill all field')</script>";
    }else if(strcmp($pwd,$cpwd)!=0){
        echo "<script>alert('Password and Confirm password must match..')</script>";
    }else{
        $query="UPDATE tbl_admin SET admin_password='$pwd' WHERE admin_email='$email'";
        $result=mysqli_query($con,$query);
        if($result){
            header("location:loginadmin.php");
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="css/resetpass.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row px-3">
      <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
        <div class="img-left d-none d-md-flex"></div>

        <div class="card-body">
          <h4 class="title text-center mt-4">
            RESET PASSWORD
          </h4>

          <hr class="my-4">

          <form class="form-box px-3" method="POST">
            <div class="form-input">
              <span><i class="fa fa-envelope-o"></i></span>
              <input type="password" name="pwd" placeholder="New Password">
            </div>

            <div class="form-input">
              <span><i class="fa fa-envelope-o"></i></span>
              <input type="password" name="cpwd" placeholder="Confirm Password">
            </div>
           
            <div class="mb-3">
              <button type="submit" name="submit" class="btn btn-block text-uppercase">
                RESET PASSWORD
              </button>
            </div>

            <div class="text-center">
              <a href="forgot_pass.php" class="forget-link">
                BACK
              </a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  </body>
</html>