<?php
$con = mysqli_connect("localhost", "root", "", "furniture");
$id = $_GET['coupen_id'];
$query = "SELECT * FROM tbl_coupen WHERE coupen_id = $id";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$errors = [];

if (isset($_POST['btnUpdate'])) {
    // Validate Coupon Title
    if (empty($_POST['coupen_title'])) {
        $errors[] = "Coupon Title is required";
    } else {
        $coupen_title = $_POST['coupen_title'];
    }

    // Validate Coupon Code
    if (empty($_POST['coupen_code'])) {
        $errors[] = "Coupon Code is required";
    } else {
        $coupen_code = $_POST['coupen_code'];
    }

    // Validate Coupon Description
    if (empty($_POST['coupen_description'])) {
        $errors[] = "Coupon Description is required";
    } else {
        $coupen_description = $_POST['coupen_description'];
    }

    // Validate Coupon Image
    $target_path = $row['coupen_img'];
    if (isset($_FILES['coupen_img']) && !empty($_FILES["coupen_img"]["name"])) {
        $target_path = "./images/" . basename($_FILES['coupen_img']['name']);
        if (move_uploaded_file($_FILES['coupen_img']['tmp_name'], $target_path)) {
            // File uploaded successfully
        } else {
            $errors[] = "Failed to upload image";
        }
    }

    // Validate Coupon Discount
    if (empty($_POST['coupen_discount'])) {
        $errors[] = "Coupon Discount is required";
    } else {
        $coupen_discount = $_POST['coupen_discount'];
    }

    // If there are no validation errors, proceed with the update
    if (empty($errors)) {
        $query = "UPDATE tbl_coupen SET coupen_title='$coupen_title', coupen_code='$coupen_code', coupen_description='$coupen_description', coupen_img='$target_path', coupen_discount='$coupen_discount' WHERE coupen_id=$id";
        $res = mysqli_query($con, $query);

        if ($res) {
            echo "<script>alert('Updated Successfully!!!');</script>";
            header("location:coupen.php");
        } else {
            echo "<script>alert('Error updating coupon');</script>";
        }
    }
}
?>

<!-- Your HTML form code goes here -->
<?php include('include.php'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Update Coupon</h2>
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
                                    <input type="text" value="<?php echo $row['coupen_title'] ?>" name="coupen_title" id="coupen_title" class="form-control" placeholder="Coupon Title">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" value="<?php echo $row['coupen_code'] ?>" name="coupen_code" id="coupen_code" class="form-control" placeholder="Coupon Code">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" value="<?php echo $row['coupen_description'] ?>" name="coupen_description" id="coupen_description" class="form-control" placeholder="Coupon Description">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" name="coupen_img" id="coupen_img" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" value="<?php echo $row['coupen_discount'] ?>" name="coupen_discount" id="coupen_discount" class="form-control" placeholder="Coupon Discount">
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
