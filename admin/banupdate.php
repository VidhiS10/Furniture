<?php
$con = mysqli_connect("localhost", "root", "", "furniture");
$id = $_GET['ban_id'];
$query = "SELECT * FROM tbl_banner WHERE ban_id = $id";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$errors = [];

if (isset($_POST['btnUpdate'])) {
    // Validate ban_title
    $ban_title = trim($_POST['ban_title']);
    if (empty($ban_title)) {
        $errors[] = "Banner title is required";
    }

    // Validate ban_img
    if (!empty($_FILES['ban_img']['name'])) {
        $target_path = "./images/";
        $file_name = basename($_FILES['ban_img']['name']);
        $target_path = $target_path . $file_name;

        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_extension, $allowed_extensions)) {
            $errors[] = "Invalid file type. Please upload only JPG, JPEG, PNG, GIF, or WebP files.";
        }

        $max_file_size = 5 * 1024 * 1024; // 5 MB
        if ($_FILES['ban_img']['size'] > $max_file_size) {
            $errors[] = "File size exceeds the limit. Please upload a smaller file.";
        }

        if (move_uploaded_file($_FILES['ban_img']['tmp_name'], $target_path)) {
            // File uploaded successfully
        } else {
            $errors[] = "Error uploading ban_img. Please try again.";
        }
    } else {
        $target_path = $row['ban_img'];
    }

    // If there are no errors, proceed with the update
    if (empty($errors)) {
        $query = "UPDATE tbl_banner SET ban_title='$ban_title', ban_img='$target_path' WHERE ban_id=$id";
        $res = mysqli_query($con, $query);

        if ($res) {
            echo "Updated Successfully!!!";
            header("location:banner.php");
        } else {
            $errors[] = "Error updating banner";
        }
    }
}
?>

<?php include('include.php'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Update Banner</h2>
                    </div>
                    <div class="body">
                        <?php if (!empty($errors)) : ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors as $error) : ?>
                                        <li><?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form method="post" id="updateBannerForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" value="<?php echo $row['ban_title'] ?>" name="ban_title" id="ban_title" class="form-control" placeholder="Banner Title">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" accept="image/*" name="ban_img" id="ban_img" class="form-control">
                                </div>
                            </div>
                            <a href="banner.php" class="btn btn-secondary">Back</a>
                            <button type="submit" name="btnUpdate" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
