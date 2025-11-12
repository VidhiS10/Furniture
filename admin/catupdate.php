<?php
$con = mysqli_connect("localhost", "root", "", "furniture");
$id = $_GET['cat_id'];
$query = "SELECT * FROM tbl_category WHERE cat_id = $id";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$errors = [];

if (isset($_POST['btnUpdate'])) {
    // Validate cat_name
    $cat_name = trim($_POST['cat_name']);
    if (empty($cat_name)) {
        $errors[] = "Category name is required";
    }

    // Validate cat_pic1
    if (!empty($_FILES['cat_pic1']['name'])) {
        $target_path = "./images/";
        $file_name = basename($_FILES['cat_pic1']['name']);
        $target_path = $target_path . $file_name;

        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif' ,'webp'];
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_extension, $allowed_extensions)) {
            $errors[] = "Invalid file type. Please upload only JPG, JPEG, PNG, or GIF files.";
        }

        $max_file_size = 5 * 1024 * 1024; // 5 MB
        if ($_FILES['cat_pic1']['size'] > $max_file_size) {
            $errors[] = "File size exceeds the limit. Please upload a smaller file.";
        }

        if (move_uploaded_file($_FILES['cat_pic1']['tmp_name'], $target_path)) {
            // File uploaded successfully
        } else {
            $errors[] = "Error uploading cat_pic1. Please try again.";
        }
    } else {
        $target_path = $row['cat_pic1'];
    }

    // Validate cat_pic2
    if (!empty($_FILES['cat_pic2']['name'])) {
        $target_path1 = "./images/";
        $file_name1 = basename($_FILES['cat_pic2']['name']);
        $target_path1 = $target_path1 . $file_name1;

        $allowed_extensions1 = ['jpg', 'jpeg', 'png', 'gif' ,'webp'];
        $file_extension1 = strtolower(pathinfo($file_name1, PATHINFO_EXTENSION));

        if (!in_array($file_extension1, $allowed_extensions1)) {
            $errors[] = "Invalid file type. Please upload only JPG, JPEG, PNG, or GIF files.";
        }

        $max_file_size1 = 5 * 1024 * 1024; // 5 MB
        if ($_FILES['cat_pic2']['size'] > $max_file_size1) {
            $errors[] = "File size exceeds the limit. Please upload a smaller file.";
        }

        if (move_uploaded_file($_FILES['cat_pic2']['tmp_name'], $target_path1)) {
            // File uploaded successfully
        } else {
            $errors[] = "Error uploading cat_pic2. Please try again.";
        }
    } else {
        $target_path1 = $row['cat_pic2'];
    }

    // If there are no errors, proceed with the update
    if (empty($errors)) {
        $query = "UPDATE tbl_category SET cat_name='$cat_name', cat_pic1='$target_path', cat_pic2='$target_path1' WHERE cat_id=$id";
        $res = mysqli_query($con, $query);

        if ($res) {
            echo "Updated Successfully!!!";
            header("location:category.php");
        } else {
            $errors[] = "Error updating category";
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
                        <h2>Update Category</h2>
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
                        <form method="post" id="addForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" value="<?php echo $row['cat_name'] ?>" name="cat_name" id="cat_name" class="form-control" placeholder="Category">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" accept="image/*" name="cat_pic1" id="cat_pic1" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" accept="image/*" name="cat_pic2" id="cat_pic2" class="form-control">
                                </div>
                            </div>
                            <a href="category.php" class="btn btn-secondary">Back</a>
                            <button type="submit" name="btnUpdate" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
