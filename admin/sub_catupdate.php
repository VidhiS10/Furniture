<?php
$con = mysqli_connect("localhost", "root", "", "furniture");
$id = $_GET['sub_cat_id'];
$query = "SELECT * FROM tbl_sub_category WHERE sub_cat_id = $id";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$errors = [];

if (isset($_POST['btnUpdate'])) {
    // Validate sub_cat_name
    $sub_cat_name = trim($_POST['sub_cat_name']);
    if (empty($sub_cat_name)) {
        $errors[] = "Product name is required";
    }

    // Validate sub_cat_color
    $sub_cat_color = trim($_POST['sub_cat_color']);
    if (empty($sub_cat_color)) {
        $errors[] = "Product color is required";
    }

    $sub_cat_price = trim($_POST['sub_cat_price']);
    if (empty($sub_cat_price)) {
        $errors[] = "Product price is required";
    }

    $sub_cat_discount = trim($_POST['sub_cat_discount']);
    if (empty($sub_cat_discount)) {
        $errors[] = "Product discount is required";
    }

    $sub_cat_description = trim($_POST['sub_cat_description']);
    if (empty($sub_cat_description)) {
        $errors[] = "Product description is required";
    }

    $sub_cat_dimention = trim($_POST['sub_cat_dimention']);
    if (empty($sub_cat_dimention)) {
        $errors[] = "Product dimension is required";
    }

    $sub_cat_weight = trim($_POST['sub_cat_weight']);
    if (empty($sub_cat_weight)) {
        $errors[] = "Product weight is required";
    }

    $sub_cat_primary_material = trim($_POST['sub_cat_primary_material']);
    if (empty($sub_cat_primary_material)) {
        $errors[] = "Product material is required";
    }

    $sub_cat_warenty = trim($_POST['sub_cat_warenty']);
    if (empty($sub_cat_warenty)) {
        $errors[] = "Product warranty is required";
    }

    $sub_cat_product_rating = trim($_POST['sub_cat_product_rating']);
    if (empty($sub_cat_product_rating)) {
        $errors[] = "Product rating is required";
    }

    $sub_cat_sku = trim($_POST['sub_cat_sku']);
    if (empty($sub_cat_sku)) {
        $errors[] = "Product SKU is required";
    }

    $sub_cat_specification = trim($_POST['sub_cat_specification']);
    if (empty($sub_cat_specification)) {
        $errors[] = "Product specification is required";
    }

    // Validate other fields as needed

    // Handle image uploads
    $target_paths = [];

    $image_fields = ['sub_cat_pic1', 'sub_cat_pic2', 'sub_cat_pic3', 'sub_cat_pic4'];

    foreach ($image_fields as $field) {
        if (!empty($_FILES[$field]['name'])) {
            $target_path = "./images/" . basename($_FILES[$field]['name']);
            $target_paths[$field] = $target_path;

            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $file_extension = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));

            if (!in_array($file_extension, $allowed_extensions)) {
                $errors[] = "Invalid file type for $field. Please upload only JPG, JPEG, PNG, GIF, or WebP files.";
            }

            $max_file_size = 5 * 1024 * 1024; // 5 MB
            if ($_FILES[$field]['size'] > $max_file_size) {
                $errors[] = "File size exceeds the limit for $field. Please upload a smaller file.";
            }

            if (!move_uploaded_file($_FILES[$field]['tmp_name'], $target_path)) {
                $errors[] = "Error uploading $field. Please try again.";
            }
        } else {
            $target_paths[$field] = $row[$field]; // Keep the existing image path
        }
    }

    // If there are no errors, proceed with the update
    if (empty($errors)) {
        $query = "UPDATE tbl_sub_category SET 
            sub_cat_name = '$sub_cat_name',
            sub_cat_color = '$sub_cat_color',
            sub_cat_price = '$sub_cat_price', 
            sub_cat_discount = '$sub_cat_discount', 
            sub_cat_description = '$sub_cat_description', 
            sub_cat_dimention = '$sub_cat_dimention', 
            sub_cat_weight = '$sub_cat_weight', 
            sub_cat_primary_material = '$sub_cat_primary_material', 
            sub_cat_warenty = '$sub_cat_warenty', 
            sub_cat_product_rating = '$sub_cat_product_rating', 
            sub_cat_sku = '$sub_cat_sku', 
            sub_cat_specification = '$sub_cat_specification', 
            sub_cat_pic1 = '$target_paths[sub_cat_pic1]', 
            sub_cat_pic2 = '$target_paths[sub_cat_pic2]', 
            sub_cat_pic3 = '$target_paths[sub_cat_pic3]', 
            sub_cat_pic4 = '$target_paths[sub_cat_pic4]'
            WHERE sub_cat_id = $id";

        $res = mysqli_query($con, $query);

        if ($res) {
            echo "Updated Successfully!!!";
            header("location:sub_category.php");
            exit; // Make sure to exit after redirection
        } else {
            $errors[] = "Error updating product";
        }
    }
    else{
        // Handle the case where there are errors, if needed
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
                        <h2>Update Product</h2>
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
                        <form method="post" id="updateProductForm" enctype="multipart/form-data">
                        <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="<?php echo $row['sub_cat_name']?>" name="sub_cat_name" id="sub_cat_name" class="form-control" placeholder="Product Name">
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="<?php echo $row['sub_cat_color']?>" name="sub_cat_color" id="sub_cat_color" class="form-control" placeholder="Product Color">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="<?php echo $row['sub_cat_price']?>" name="sub_cat_price" id="sub_cat_price" class="form-control" placeholder="Product Price">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="<?php echo $row['sub_cat_discount']?>" name="sub_cat_discount" id="sub_cat_discount" class="form-control" placeholder="Product Discount">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="<?php echo $row['sub_cat_description']?>" name="sub_cat_description" id="sub_cat_description" class="form-control" placeholder="Product Description">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="<?php echo $row['sub_cat_dimention']?>" name="sub_cat_dimention" id="sub_cat_dimention" class="form-control" placeholder="Product Dimention">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="<?php echo $row['sub_cat_weight']?>" name="sub_cat_weight" id="sub_cat_weight" class="form-control" placeholder="Product Weight">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="<?php echo $row['sub_cat_primary_material']?>" name="sub_cat_primary_material" id="sub_cat_primary_material" class="form-control" placeholder="Product Material">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="<?php echo $row['sub_cat_warenty']?>" name="sub_cat_warenty" id="sub_cat_warenty" class="form-control" placeholder="Product Warrenty">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="<?php echo $row['sub_cat_product_rating']?>" name="sub_cat_product_rating" id="sub_cat_product_rating" class="form-control" placeholder="Product Rating">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="<?php echo $row['sub_cat_sku']?>" name="sub_cat_sku" id="sub_cat_sku" class="form-control" placeholder="Product SKU">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="<?php echo $row['sub_cat_specification']?>" name="sub_cat_specification" id="sub_cat_specification" class="form-control" placeholder="Product Specfication">
                                    </div>
                                </div>
                                

                                <!-- <img src="<?php echo $row['sub_cat_pic1']?>" height="100" width="100" alt=""> -->
                                <!-- <img src="<?php echo $row['sub_cat_pic2']?>" height="100" width="100" alt=""> -->
                                <!-- <img src="<?php echo $row['sub_cat_pic3']?>" height="100" width="100" alt=""> -->
                                <!-- <img src="<?php echo $row['sub_cat_pic4']?>" height="100" width="100" alt=""> -->


                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" name="sub_cat_pic1" id="sub_cat_pic1" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" name="sub_cat_pic2" id="sub_cat_pic2" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" name="sub_cat_pic3" id="sub_cat_pic3" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" name="sub_cat_pic4" id="sub_cat_pic4" class="form-control" >
                                    </div>
                                </div>
                                    <a href="sub_category.php" class="btn btn-secondary">Back</a>
                                    <button type="submit" name="btnUpdate" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
