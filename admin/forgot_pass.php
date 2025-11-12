<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="css/forgetpass.css">
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
            FORGET PASSWORD
          </h4>

          <hr class="my-4">

          <form class="form-box px-3" method="POST">
            <div class="form-input">
              <span><i class="fa fa-envelope-o"></i></span>
              <input type="email" name="admin_email" placeholder="Email">
            </div>
           
            <div class="mb-3">
              <button type="submit" name="submit" class="btn btn-block text-uppercase">
                Submit
              </button>
            </div>

            <div class="text-center">
              <a href="loginadmin.php" class="forget-link">
                BACK
              </a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
<?php
$con = mysqli_connect("localhost", "root", "", "furniture");

if(isset($_POST['submit'])){
  $email=$_POST['admin_email'];
  $query="SELECT * FROM tbl_admin WHERE admin_email='$email'";

  $result=mysqli_query($con,$query);
  $count=mysqli_num_rows($result);
  if($count>0){
    header("location:reset.php?email=$email");
  }else{
    echo "<script>alert('no email found..')</script>";
  }
}

?>
</body>
</html>

