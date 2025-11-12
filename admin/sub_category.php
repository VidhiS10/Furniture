<?php
include('include.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-black">Product Table</h1>

  <button class="btn btn-info bg-primary" data-bs-target="#modal" aria-controls="modal" data-bs-toggle="modal"><i class="bi bi-plus-circle"></i>Add Product</button>
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <table class="table table-grey text-black">
        <thead>
          <tr>
            <th>Product ID</th>
            <th>Cat ID</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Pic1</th>
            <th>Product Pic2</th>
            <th>View</th>
            <th>Update</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <b class="text-primary">
            <?php 
              $con = mysqli_connect("localhost","root","","furniture");

              // Pagination variables
              $results_per_page = 5;
              $query = "SELECT * FROM tbl_sub_category";
              $result = mysqli_query($con, $query);
              $number_of_results = mysqli_num_rows($result);
              $number_of_pages = ceil($number_of_results / $results_per_page);

              if (!isset($_GET['page'])) {
                $page = 1;
              } else {
                $page = $_GET['page'];
              }

              $this_page_first_result = ($page - 1) * $results_per_page;

              // Query with pagination
              $query = "SELECT * FROM tbl_sub_category LIMIT $this_page_first_result, $results_per_page";
              $res = mysqli_query($con, $query);

              if (mysqli_num_rows($res) > 0){
                while($row=mysqli_fetch_assoc($res)){
                  echo"<tr>";
                  echo "<td>".$row['sub_cat_id']."</td>";
                  echo "<td>".$row['cat_id']."</td>";
                  echo "<td>".$row['sub_cat_name']."</td>";
                  echo "<td>".$row['sub_cat_price']."</td>";
                  echo "<td> <img src='" . $row['sub_cat_pic1'] . "' class='img-circle' height='100' width='100'></td>";
                  echo "<td> <img src='" . $row['sub_cat_pic2'] . "' class='img-circle' height='100' width='100'></td>";
          ?>
                  <td><a href="sub_catview.php?sub_cat_id=<?php echo $row['sub_cat_id'];?>"  class="view btn btn-warning shadow btn-xs sharp"><i class="fa-solid fa-eye"></i></a></td>
                  <td><a href="sub_catupdate.php?sub_cat_id=<?php echo  $row['sub_cat_id'];?>"><i id="i1" class="edit bi bi-pencil-square btn btn-primary shadow btn-xs sharp"></i></a></td>
                  <td><a href="#deleteModal" data-id="<?php echo $row['sub_cat_id']?>" data-bs-toggle="modal" class="delete btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></td>
          <?php
                  echo"</tr>";
                }
              } else {
                echo "<tr><td colspan='9'>No data found.</td></tr>";
              }
            ?>
          </b>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination -->
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php
            for ($page = 1; $page <= $number_of_pages; $page++) {
              echo '<li class="page-item"><a class="page-link" href="?page=' . $page . '">' . $page . '</a></li>';
            }
          ?>
        </ul>
      </nav>
    </div>
  </div>
  <!-- End Pagination -->

  <!-- add modal -->
<div class="modal" id="modal">
  <div class="modal-dialog">
  	<form method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h2 class="modal-title">ADD PRODUCT</h2>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
      </div>
    
      <div class="modal-body">
        <p class="lead text-center">
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-menu-button-fill"></i></span>
            <select name="cat_id" class="form-control">
                    <?php
                      $query = "SELECT * FROM tbl_category";
                      $res = mysqli_query($con,$query);
                      while($row = mysqli_fetch_assoc($res)){
                    ?>
                      <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
                    <?php 
                  }
                ?>
            </select>
          </div>

           <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-cloud-plus"></i></span>
            <input type="text" name="sub_cat_name" class="form-control" placeholder="Product Name" aria-label="sub_cat_name" aria-describedby="basic-addon1">
          </div>

		  <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-palette-fill"></i></span>
            <input type="text" name="sub_cat_color" class="form-control" placeholder="Product Color" aria-label="sub_cat_color" aria-describedby="basic-addon1">
          </div>

		  <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-currency-rupee"></i></span>
            <input type="text" name="sub_cat_price" class="form-control" placeholder="Product Price" aria-label="sub_cat_price" aria-describedby="basic-addon1">
          </div>

		  <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-percent"></i></span>
            <input type="text" name="sub_cat_discount" class="form-control" placeholder="Product Discount" aria-label="sub_cat_discount" aria-describedby="basic-addon1">
          </div>

		  <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-chat-text"></i></span>
            <input type="text" name="sub_cat_description" class="form-control" placeholder="Product Description" aria-label="sub_cat_description" aria-describedby="basic-addon1">
          </div>

		  <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-input-cursor"></i></span>
            <input type="text" name="sub_cat_dimention" class="form-control" placeholder="Product Dimention" aria-label="sub_cat_dimention" aria-describedby="basic-addon1">
          </div>

		  <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-stars"></i></span>
            <input type="text" name="sub_cat_weight" class="form-control" placeholder="Product Weight" aria-label="sub_cat_weight" aria-describedby="basic-addon1">
          </div>

		  <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-mastodon"></i></span>
            <input type="text" name="sub_cat_primary_material" class="form-control" placeholder="Product Primary Material" aria-label="sub_cat_primary_material" aria-describedby="basic-addon1">
          </div>

		  <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-file-word-fill"></i></span>
            <input type="text" name="sub_cat_warenty" class="form-control" placeholder="Product Warenty" aria-label="sub_cat_warenty" aria-describedby="basic-addon1">
          </div>

		  <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-star-fill"></i></span>
            <input type="text" name="sub_cat_product_rating" class="form-control" placeholder="Product Rating" aria-label="sub_cat_product_rating" aria-describedby="basic-addon1">
          </div>

		  <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-stripe"></i></span>
            <input type="text" name="sub_cat_sku" class="form-control" placeholder="Product Sku" aria-label="sub_cat_sku" aria-describedby="basic-addon1">
          </div>

		  <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-stripe"></i></span>
            <input type="text" name="sub_cat_specification" class="form-control" placeholder="Product Specification" aria-label="sub_cat_specification" aria-describedby="basic-addon1">
          </div>

          <div class="input-group mb-3">
            <input class="form-control" type="file" name="sub_cat_pic1">
		</div>

        <div class="input-group mb-3">
            <input class="form-control" type="file" name="sub_cat_pic2">
		</div>

		<div class="input-group mb-3">
            <input class="form-control" type="file" name="sub_cat_pic3">
		</div>

		<div class="input-group mb-3">
            <input class="form-control" type="file" name="sub_cat_pic4">
		</div>

      <div class="modal-footer">
        <button class="btn btn-outline-primary" data-bs-dismiss="modal">close</button>
        <button class="btn btn-outline-primary" name="submit" type="submit">Add</button>
      </div>

  </form>
    </div>
  </div>
</div>
</div>
<!-- add modal -->

<!-- delete modal -->

<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-dark">
        <h5 class="modal-title">Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <p>Are You sure want to delete?</p>
        <input type="hidden" id="id_d">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="btnDelete"  class="btn btn-danger">Confirm</button>
      </div>
    </div>
  </div>
</div>

<!-- delete modal -->

<?php
$con = mysqli_connect("localhost", "root", "", "furniture");

$errors = [];

if (isset($_POST['submit'])) {
    // Validate required fields
    if (empty($_POST['sub_cat_name'])) {
        $errors[] = "Product name is required";
    } elseif (empty($_POST['sub_cat_color'])) {
        $errors[] = "Product Color is required";
    } elseif (empty($_POST['sub_cat_price'])) {
        $errors[] = "Product price is required";
    } elseif (empty($_POST['sub_cat_discount'])) {
        $errors[] = "Product discount is required";
    } elseif (empty($_POST['sub_cat_description'])) {
        $errors[] = "Product description is required";
    } elseif (empty($_POST['sub_cat_dimention'])) {
        $errors[] = "Product dimention is required";
    } elseif (empty($_POST['sub_cat_weight'])) {
        $errors[] = "Product weight is required";
    } elseif (empty($_POST['sub_cat_primary_material'])) {
        $errors[] = "Product Primary Material is required";
    } elseif (empty($_POST['sub_cat_warenty'])) {
        $errors[] = "Product Warranty is required";
    } elseif (empty($_POST['sub_cat_product_rating'])) {
        $errors[] = "Product Product Rating is required";
    } elseif (empty($_POST['sub_cat_sku'])) {
        $errors[] = "Product SKU is required";
    } elseif (empty($_POST['sub_cat_specification'])) {
        $errors[] = "Product Specification is required";
    } elseif (empty($_FILES['sub_cat_pic1']['name'])) {
        $errors[] = "Product Pic1 is required";
    } elseif (empty($_FILES['sub_cat_pic2']['name'])) {
        $errors[] = "Product Pic2 is required";
    } elseif (empty($_FILES['sub_cat_pic3']['name'])) {
        $errors[] = "Product Pic3 is required";
    } elseif (empty($_FILES['sub_cat_pic4']['name'])) {
        $errors[] = "Product Pic4 is required";
    } else {
        // Check file extensions for image files
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        // Check for Pic1
        $pic1_extension = strtolower(pathinfo($_FILES['sub_cat_pic1']['name'], PATHINFO_EXTENSION));
        if (!in_array($pic1_extension, $allowed_extensions)) {
            $errors[] = "Invalid file type for Product Pic1. Please upload only JPG, JPEG, PNG, GIF, or WebP files.";
        }

        // Check for Pic2
        $pic2_extension = strtolower(pathinfo($_FILES['sub_cat_pic2']['name'], PATHINFO_EXTENSION));
        if (!in_array($pic2_extension, $allowed_extensions)) {
            $errors[] = "Invalid file type for Product Pic2. Please upload only JPG, JPEG, PNG, GIF, or WebP files.";
        }

        // Check for Pic3
        $pic3_extension = strtolower(pathinfo($_FILES['sub_cat_pic3']['name'], PATHINFO_EXTENSION));
        if (!in_array($pic3_extension, $allowed_extensions)) {
            $errors[] = "Invalid file type for Product Pic3. Please upload only JPG, JPEG, PNG, GIF, or WebP files.";
        }

        // Check for Pic4
        $pic4_extension = strtolower(pathinfo($_FILES['sub_cat_pic4']['name'], PATHINFO_EXTENSION));
        if (!in_array($pic4_extension, $allowed_extensions)) {
            $errors[] = "Invalid file type for Product Pic4. Please upload only JPG, JPEG, PNG, GIF, or WebP files.";
        }

        // If no errors, proceed with data insertion
        if (empty($errors)) {
            $sub_cat_name = $_POST['sub_cat_name'];
            $sub_cat_color = $_POST['sub_cat_color'];
            $sub_cat_price = $_POST['sub_cat_price'];
            $sub_cat_discount = $_POST['sub_cat_discount'];
            $sub_cat_description = $_POST['sub_cat_description'];
            $sub_cat_dimention = $_POST['sub_cat_dimention'];
            $sub_cat_weight = $_POST['sub_cat_weight'];
            $sub_cat_primary_material = $_POST['sub_cat_primary_material'];
            $sub_cat_warenty = $_POST['sub_cat_warenty'];
            $sub_cat_product_rating = $_POST['sub_cat_product_rating'];
            $sub_cat_sku = $_POST['sub_cat_sku'];
            $sub_cat_specification = $_POST['sub_cat_specification'];
            $cat_id = $_POST['cat_id'];

            // Upload images
            $folderpath1 = "./images/" . $_FILES['sub_cat_pic1']['name'];
            $folderpath2 = "./images/" . $_FILES['sub_cat_pic2']['name'];
            $folderpath3 = "./images/" . $_FILES['sub_cat_pic3']['name'];
            $folderpath4 = "./images/" . $_FILES['sub_cat_pic4']['name'];

            if (move_uploaded_file($_FILES['sub_cat_pic1']['tmp_name'], $folderpath1) &&
                move_uploaded_file($_FILES['sub_cat_pic2']['tmp_name'], $folderpath2) &&
                move_uploaded_file($_FILES['sub_cat_pic3']['tmp_name'], $folderpath3) &&
                move_uploaded_file($_FILES['sub_cat_pic4']['tmp_name'], $folderpath4)) {
                // Insert data into database
                $qry = "INSERT INTO tbl_sub_category(sub_cat_name, sub_cat_color, sub_cat_price, sub_cat_discount, sub_cat_description, sub_cat_dimention, sub_cat_weight, sub_cat_primary_material, sub_cat_warenty, sub_cat_product_rating, sub_cat_sku, sub_cat_specification, sub_cat_pic1, sub_cat_pic2, sub_cat_pic3, sub_cat_pic4, cat_id) 
                        VALUES ('$sub_cat_name', '$sub_cat_color', '$sub_cat_price', '$sub_cat_discount', '$sub_cat_description', '$sub_cat_dimention', '$sub_cat_weight', '$sub_cat_primary_material', '$sub_cat_warenty', '$sub_cat_product_rating', '$sub_cat_sku', '$sub_cat_specification', '$folderpath1', '$folderpath2', '$folderpath3', '$folderpath4', '$cat_id')";
                $res = mysqli_query($con, $qry);

                if ($res) {
                    echo "<script>alert('Product added successfully');</script>";
                } else {
                    $errors[] = "Error inserting data: " . mysqli_error($con);
                }
            } else {
                $errors[] = "Error uploading images.";
            }
        }
    }

    // If there are any errors, display them in a dialog box
    if (!empty($errors)) {
        echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
    }
}
?>



<?php
include('footer.php');
?>

<script type="text/javascript">
	$(document).on("click",".delete",function(){
		var id=$(this).attr("data-id");
		$('#id_d').val(id);
	});

	$(document).on("click","#btnDelete",function(){
		$.ajax({
			url:"sub_catdelete.php",
			type:"POST",
			cache:false,
			data:{
				type:1,
				id:$('#id_d').val()
			},
			success:function(dataResult){
				$("#deleteModal").modal('hide');
				// alert(dataResult);
				location.reload();
			}
		});
	});

</script>
