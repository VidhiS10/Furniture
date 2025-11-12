<?php
include('include.php');

$con = mysqli_connect("localhost","root","","furniture");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set
    if (isset($_POST['old_password'], $_POST['new_password'], $_POST['confirm_password'])) {
        // Retrieve form data
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Retrieve user's current password from the database
        $query = "SELECT admin_password FROM tbl_admin WHERE admin_name = '" . $_SESSION['admin_name'] . "'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        
        if ($row) {
            $stored_password = $row['admin_password'];
            
            // Verify if old password matches the stored password
            if ($old_password != $stored_password) {
                $error_message = "Old password is incorrect.";
            } else {
                // Verify if new password and confirm password match
                if ($new_password != $confirm_password) {
                    $error_message = "New password and confirm password do not match.";
                } else {
                    // Update user's password in the database
                    $update_query = "UPDATE tbl_admin SET admin_password = '$new_password' WHERE admin_name = '" . $_SESSION['admin_name'] . "'";
                    mysqli_query($con, $update_query);
                    $success_message = "Password updated successfully.";
                }
            }
        } else {
            $error_message = "User not found.";
        }
    } else {
        $error_message = "All fields are required.";
    }
}
?>

<!-- Your HTML form and layout here -->


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
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px"
                     src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">

                <div class="text-center display-6 my-2 text-dark">
                    <b>Welcome <?php echo $_SESSION["admin_name"]; ?></b>
                </div>
            </div>
        </div>
        <form method="POST" class="col-md-9 border-right">
            <div class="py-5">
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
                <hr id="hr" style="border:1px solid black">
                <div class="row mt-5">
                    <div class="col-md-12">
                        <label class="col-md-12">Old Password :
                            <input type="password" name="old_password" class="form-control"
                                   placeholder="Old Password" value="">
                        </label>
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-12">New Password :
                            <input type="password" name="new_password" class="form-control"
                                   placeholder="New Password" value="">
                        </label>
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-12">Retype New Password :
                            <input type="password" name="confirm_password" class="form-control"
                                   placeholder="Retype New Password" value="">
                        </label>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="submit" name="Submit">Submit</button>
                </div>
                <?php
                if (isset($error_message)) {
                    echo "<div class='alert alert-danger mt-3'>$error_message</div>";
                } elseif (isset($success_message)) {
                    echo "<div class='alert alert-success mt-3'>$success_message</div>";
                }
                ?>
            </div>
        </form>
    </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>
