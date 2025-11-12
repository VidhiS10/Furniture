<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="admin.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row px-3">
      <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
        <div class="img-left d-none d-md-flex"></div>

        <div class="card-body">
          <h4 class="title text-center mt-4">ADD NEW ADMIN</h4>
          <form class="form-box px-3" method="POST" id="adminForm">
            <div class="form-input">
              <span><i class="bi bi-person-circle"></i></span>
              <input type="text" name="admin_name" id="admin_name" placeholder="Name">
            </div>
            <div class="form-input">
              <span><i class="fa fa-envelope-o"></i></span>
              <input type="email" name="admin_email" id="admin_email" placeholder="Email Address">
            </div>
            <div class="form-input">
              <span><i class="bi bi-phone"></i></span>
              <input type="tel" name="admin_mobile" id="admin_mobile" placeholder="Mobile Number">
            </div>
            <div class="form-input">
              <span><i class="fa fa-key"></i></span>
              <input type="password" name="admin_password" id="admin_password" placeholder="Password">
            </div>

            <div class="mb-3">
              <button type="button" name="Submit" class="btn btn-block text-uppercase" onclick="validateForm()">ADD</button>
            </div>
            <div class="mb-3 button">
              <a type="button" class="btn btn-block text-uppercase" href="admin.php">Back</a>
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

  <script>
    function validateForm() {
      var adminName = document.getElementById('admin_name').value.trim();
      var adminEmail = document.getElementById('admin_email').value.trim();
      var adminMobile = document.getElementById('admin_mobile').value.trim();
      var adminPassword = document.getElementById('admin_password').value.trim();

      if (adminName === '' || adminEmail === '' || adminMobile === '' || adminPassword === '') {
        showErrorModal('All fields are required.');
        return;
      }

      if (!isValidEmail(adminEmail)) {
        showErrorModal('Invalid email format.');
        return;
      }

      if (!isValidMobile(adminMobile)) {
        showErrorModal('Invalid mobile number.');
        return;
      }

      // If all validations pass, submit the form
      document.getElementById('adminForm').submit();
    }

    function showErrorModal(message) {
      $('#errorModalBody').text(message);
      $('#errorModal').modal('show');
    }

    function isValidEmail(email) {
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }

    function isValidMobile(mobile) {
      var mobileRegex = /^[0-9]{10}$/;
      return mobileRegex.test(mobile);
    }
  </script>
</body>
</html>

<?php
$con = mysqli_connect("localhost", "root", "", "furniture");

if (isset($_POST['Submit'])) {
  $admin_name = $_POST['admin_name'];
  $admin_email = $_POST['admin_email'];
  $admin_mobile = $_POST['admin_mobile'];
  $admin_password = $_POST['admin_password'];

  $qry = "INSERT INTO tbl_admin(admin_name, admin_email, admin_mobile, admin_password) VALUES('$admin_name','$admin_email','$admin_mobile','$admin_password')";
  $res = mysqli_query($con, $qry);

  if ($res) {
    // Add success message handling here
  } else {
    // Add error message handling here
  }
}
?>
