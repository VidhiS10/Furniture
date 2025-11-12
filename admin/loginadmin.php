<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Form</title>
  <link rel="stylesheet" type="text/css" href="css/loginadmin.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row px-3">
      <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
        <div class="img-left d-none d-md-flex"></div>

        <div class="card-body">
          <h4 class="title text-center mt-4">
            ADMIN LOGIN
          </h4>

          <hr class="my-4">

          <form class="form-box px-3" method="POST">
            <div class="form-input">
              <span><i class="bi bi-person-circle"></i></span>
              <input type="text" name="admin_name" placeholder="Admin Name">
            </div>
            <div class="form-input">
              <span><i class="fa fa-key"></i></span>
              <input type="password" name="admin_password" placeholder="Password">
            </div>

            <div class="mb-3">
              <button type="submit" name="submit" class="btn btn-block text-uppercase">
                Login
              </button>
            </div>

            <div class="text-center">
              <a href="forgot_pass.php" class="forget-link">
                Forget Password?
              </a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Modal for displaying errors -->
  <div class="modal" id="errorModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Error</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <h6 class="modal-body text-danger" id="errorModalBody"></h6>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <?php
    $con=mysqli_connect("localhost","root","","furniture");
    session_start();

    if(isset($_POST['submit']))
    {
        $admin_name=$_POST['admin_name'];
        $admin_password=$_POST['admin_password'];

        if($admin_name=="" && $admin_password=="")
        {
            showErrorModal('Username and Password cannot be blank.');
        }
        elseif($admin_name=="" )
        {
            showErrorModal('Username cannot be blank.');
        }
        elseif($admin_password=="")
        {
            showErrorModal('Password cannot be blank.');
        }
        else
        {
            $qry="select * from tbl_admin where admin_name='$admin_name' and admin_password='$admin_password'";
            $result=mysqli_query($con,$qry);
            $row=mysqli_fetch_array($result);
            $count=mysqli_num_rows($result);

            if($count>0){
                $_SESSION["admin_name"]=$admin_name;
                $_SESSION["admin_email"]=$row['admin_email'];
                $_SESSION["admin_mobile"]=$row['admin_mobile'];
                $_SESSION["admin_id"]=$row['admin_id'];

                header("Location:admin.php");
            }
            else
            {
                showErrorModal('Invalid username or password.');
            }
        }
    }

    function showErrorModal($message) {
        echo "<script>
                document.getElementById('errorModalBody').innerHTML = '$message';
                $('#errorModal').modal('show');
              </script>";
    }
  ?>
</body>
</html>
