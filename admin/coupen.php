<?php
include('include.php');
?>



  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->

<!-- Page Heading -->
<h1 class="h3 mb-4 text-black">Coupen Table</h1>

	<button class="btn btn-info bg-primary" data-bs-target="#modal" aria-controls="modal" data-bs-toggle="modal"><i class="bi bi-plus-circle"></i> Add Coupen</button>
	<div class="row justify-content-center">
		<div class="col-lg-12">
<table class="table table-grey text-black">
	<thead>
			
		<tr>
      <th>Sr. No.</th>
			<th>Coupen ID</th>
			<th>Coupen Title</th>
			<th>Coupen Code</th>
			<th>Coupen Description</th>
			<th>Coupen Img</th>
			<th>Coupen Discount</th>
			<th>Delete</th>
			<th>Update</th>
			
		</tr>
	</thead>
    <tbody>
        <b class="text-primary">


    <?php 
$con = mysqli_connect("localhost","root","","furniture");

$query="SELECT * FROM tbl_coupen order by coupen_id";

$res=mysqli_query($con,$query);

$count=mysqli_num_rows($res);
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$limit = 5; // Number of records per page
$start = ($page - 1) * $limit; // Starting row number for query

if ($count>0){
  $serialNumber = $start + 1; // Initialize serial number counter
	while($row=mysqli_fetch_assoc($res)){
		echo"<tr>";
    echo "<td>" . $serialNumber++ . "</td>"; // Display serial number
	echo "<td>".$row['coupen_id']."</td>";
	echo "<td>".$row['coupen_title']."</td>";
	echo "<td>".$row['coupen_code']."</td>";
	echo "<td>".$row['coupen_description']."</td>";
  echo "<td> <img src='" . $row['coupen_img'] . "' class='img-circle' height='100' width='100'></td>";
	echo "<td>".$row['coupen_discount']."</td>";
	?>



<td><a href="#deleteModal" data-id="<?php echo $row['coupen_id']?>" 
data-bs-toggle="modal" class="delete btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i>
  </a></td>

			<td> <a href="coupenupdate.php?coupen_id=<?php echo  $row['coupen_id'];?>"><i id="i1" class="edit bi bi-pencil-square btn btn-primary shadow btn-xs sharp" 
       ></i></a></td>

	<?php

	echo"</tr>";
}
}
else
{
	echo "NO data Found";
}
?>

</b>
</tbody>

</table>
</div>
</div>

<!-- add modal -->
<div class="modal" id="modal">
  <div class="modal-dialog">
  	<form method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h2 class="modal-title">ADD COUPEN</h2>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
      </div>
    
      <div class="modal-body">
        <p class="lead text-center">
           <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-ticket-perforated"></i></span>
            <input type="text" name="coupen_title" class="form-control" placeholder="Coupen Title" aria-label="coupen_title" aria-describedby="basic-addon1">
          </div>

           <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-1-circle"></i></i></span>
            <input type="text" name="coupen_code" class="form-control" placeholder="Coupen Code" aria-label="coupen_code" aria-describedby="basic-addon1">
          </div>
          
           <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-chat-text"></i></span>
            <input type="text" name="coupen_description" class="form-control" placeholder="Coupen Description" aria-label="coupen_description" aria-describedby="basic-addon1">
          </div>

          <div class="input-group mb-3">
            <input class="form-control" type="file" name="coupen_img">
		</div>

           <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-percent"></i></span>
            <input type="text" name="coupen_discount" class="form-control" placeholder="Coupen Discount" aria-label="coupen_discount" aria-describedby="basic-addon1">
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

$con=mysqli_connect("localhost","root","","furniture");

$errors = []; // Array to store validation errors

if(isset($_POST['submit'])) {
    // Validate Coupon Title
    if(empty($_POST['coupen_title'])) {
        $errors[] = "Coupon Title is required";
    } else {
        $coupen_title = $_POST['coupen_title'];
    }

    // Validate Coupon Code
    if(empty($_POST['coupen_code'])) {
        $errors[] = "Coupon Code is required";
    } else {
        $coupen_code = $_POST['coupen_code'];
    }

    // Validate Coupon Description
    if(empty($_POST['coupen_description'])) {
        $errors[] = "Coupon Description is required";
    } else {
        $coupen_description = $_POST['coupen_description'];
    }

    // Validate Coupon Image
    if(!isset($_FILES['coupen_img']) || $_FILES['coupen_img']['error'] === UPLOAD_ERR_NO_FILE) {
        $errors[] = "Coupon Image is required";
    } else {
        $name = $_FILES['coupen_img']['name'];
        $tempname = $_FILES['coupen_img']['tmp_name'];
        $folderpath = "./images/".$name;

        if(move_uploaded_file($tempname, $folderpath)) {
            // Image uploaded successfully
        } else {
            $errors[] = "Failed to upload image";
        }
    }

    // Validate Coupon Discount
    if(empty($_POST['coupen_discount'])) {
        $errors[] = "Coupon Discount is required";
    } else {
        $coupen_discount = $_POST['coupen_discount'];
    }

    // If there are no validation errors, proceed with database insertion
    if(empty($errors)) {
        $qry = "INSERT INTO tbl_coupen(coupen_title, coupen_code, coupen_description, coupen_img, coupen_discount) VALUES ('$coupen_title', '$coupen_code', '$coupen_description', '$folderpath', '$coupen_discount')";
        $res = mysqli_query($con, $qry);

        if($res) {
            echo "<script>alert('Coupon added successfully');</script>";
        } else {
            echo "<script>alert('Error: ". mysqli_error($con) ."');</script>";
        }
    } else {
        // Display validation errors using JavaScript alert
        echo "<script>alert('\\n" . implode("\\n", $errors) . "');</script>";
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
			url:"coupendelete.php",
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





