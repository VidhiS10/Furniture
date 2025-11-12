<?php
include('include.php');
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
        <div class="col-md-9 border-right">
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

                

                <hr id="a1" style="border:1px solid black">

                <div class="row mt-3">
                    <div class="col-md-12"><label class="col-md-5 text-secondary"><b></label><label class="col-md-4 text-dark"></label></div>
                    <div class="col-md-12"><label class="col-md-8 text-secondary"><b>Name -</label><label class="col-md-3 text-dark"><?php  echo $_SESSION["admin_name"];?></label></div>
                    <div class="col-md-12"><label class="col-md-8 text-secondary"><b>Email ID -</label><label class="col-md-4 text-dark"><?php  echo $_SESSION["admin_email"];?></label></div>
                    <div class="col-md-12"><label class="col-md-8 text-secondary"><b>Mobile Number -</label><label class="col-md-4 text-dark"><?php  echo $_SESSION["admin_mobile"];?></label></div>
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>
<?php
include('footer.php');
?>
</div>
</body>
</html>
    

