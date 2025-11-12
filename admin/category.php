<?php
include('include.php');
?>



  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->

<!-- Page Heading -->
<h1 class="h3 mb-4 text-black">Category Table</h1>

	<button class="btn btn-info bg-primary" data-bs-target="#modal" aria-controls="modal" data-bs-toggle="modal"><i class="bi bi-plus-circle"></i> Add Category</button>
	<div class="row justify-content-center">
		<div class="col-lg-12">
<table class="table table-grey text-black">
	<thead>
			
		<tr>
			<th>Category ID</th>
			<th>Category Name</th>
			<th>Cat Pic1</th>
			<th>Cat Pic2</th>
			<th>Delete</th>
			<th>Update</th>
			
		</tr>
	</thead>
    <tbody>
        <b class="text-primary">


    <?php 
$con = mysqli_connect("localhost", "root", "", "furniture");
$query="SELECT * FROM tbl_category order by cat_id";

$res=mysqli_query($con,$query);

$count=mysqli_num_rows($res);

if ($count>0){
	while($row=mysqli_fetch_assoc($res)){
		echo"<tr>";
	echo "<td>".$row['cat_id']."</td>";
	echo "<td>".$row['cat_name']."</td>";
    echo "<td> <img src='" . $row['cat_pic1'] . "' class='img-circle' height='100' width='100'></td>";
    echo "<td> <img src='" . $row['cat_pic2'] . "' class='img-circle' height='100' width='100'></td>";
	?>


<td><a href="#deleteModal" data-id="<?php echo $row['cat_id']?>" 
data-bs-toggle="modal" class="delete btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i>
  </a></td>

			<td> <a href="catupdate.php?cat_id=<?php echo  $row['cat_id'];?>"><i id="i1" class="edit bi bi-pencil-square btn btn-primary shadow btn-xs sharp" 
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
      <div class="modal-header bg-primary text-white ">
        <h2 class="modal-title">ADD CATEGORY</h2>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
      </div>
    
      <div class="modal-body">
        <p class="lead text-center">
           <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-cloud-plus"></i></span>
            <input type="text" name="cat_name" class="form-control" placeholder="Category Name" aria-label="cat_name" aria-describedby="basic-addon1">
          </div>

          <div class="input-group mb-3">
            <input class="form-control" accept="image/*" type="file" name="cat_pic1">
		</div>

        <div class="input-group">
            <input class="form-control" accept="image/*" type="file" name="cat_pic2">
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

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Validate category name
    $cat_name = $_POST['cat_name'];
    if(empty($cat_name)) {
        echo "<script>alert('Category name cannot be empty');</script>";
    } else {
        // Check if images are uploaded
        if(isset($_FILES['cat_pic1']) && isset($_FILES['cat_pic2'])) {
            // Define folder paths for images
            $folderpath1 = "./images/" . $_FILES['cat_pic1']['name'];
            $folderpath2 = "./images/" . $_FILES['cat_pic2']['name'];

            // Move uploaded images to the destination folder
            if(move_uploaded_file($_FILES['cat_pic1']['tmp_name'], $folderpath1) &&
               move_uploaded_file($_FILES['cat_pic2']['tmp_name'], $folderpath2)) {

                // Check if uploaded files are valid images
                if(getimagesize($folderpath1) !== false && getimagesize($folderpath2) !== false) {
                    // Insert data into the database

                    $q="SELECT * FROM tbl_category WHERE cat_name='$cat_name'";
                    $r=mysqli_query($con,$q);
                    $count=mysqli_num_rows($r);

                    if($count>0){
                      echo "<script>alert('Duplicate Category');</script>";

                    }else{


                    $cat_name = mysqli_real_escape_string($con, $cat_name); // Escape category name to prevent SQL injection
                    $qry = "INSERT INTO tbl_category(cat_name, cat_pic1, cat_pic2) VALUES ('$cat_name', '$folderpath1', '$folderpath2')";
                    $res = mysqli_query($con, $qry);

                    if($res) {
                        echo "<script>alert('Category added successfully');</script>";
                    } else {
                        echo "<script>alert('Error adding category');</script>";
                    }
                  }
                } else {
                    echo "<script>alert('Uploaded file is not an image');</script>";
                }
            } else {
                echo "<script>alert('Error uploading images');</script>";
            }
        } else {
            echo "<script>alert('Please upload both images');</script>";
        }
    }
}
?>


<?php
include('footer.php');
?>


<!-- delete -->
<script type="text/javascript">
	$(document).on("click",".delete",function(){
		var id=$(this).attr("data-id");
		$('#id_d').val(id);
	});

	$(document).on("click","#btnDelete",function(){
		$.ajax({
			url:"catdelete.php",
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

	//update script


</script>



