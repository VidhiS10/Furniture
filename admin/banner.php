<?php
include('include.php');
?>

  
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
         

<!-- Page Heading -->
<h1 class="h3 mb-4 text-black">Banner Table</h1>

	<button class="btn btn-info bg-primary" data-bs-target="#modal" aria-controls="modal" data-bs-toggle="modal"><i class="bi bi-plus-circle"></i> Add Banner</button>
	<div class="row justify-content-center">
		<div class="col-lg-12">
<table class="table table-grey text-black">
	<thead>
			
		<tr>
			<th>Banner ID</th>
			<th>Banner Title</th>
			<th>Banner Image</th>
			<th>Enable/Disable</th>
			<th>Delete</th>
			<th>Update</th>
			
		</tr>
	</thead>
    <tbody>
        <b class="text-primary">


    <?php 
$con = mysqli_connect("localhost","root","","furniture");

$query="SELECT * FROM tbl_banner order by ban_id";

$res=mysqli_query($con,$query);

$count=mysqli_num_rows($res);

if ($count>0){
	while($row=mysqli_fetch_assoc($res)){
		echo"<tr>";
	echo "<td>".$row['ban_id']."</td>";
	echo "<td>".$row['ban_title']."</td>";
    echo "<td> <img src='" . $row['ban_img'] . "' class='img-circle' height='100' width='100'></td>";
	?>

<td>
  <?php
                if($row['status']==1){
                    ?>
                    <a class="btn btn-danger" href="bannerupdate.php?status=0&id=<?php echo $row['ban_id']?>">Deactived</a>
                    <?php
                }else{
                    ?>
                    <a class="btn btn-primary" href="bannerupdate.php?status=1&id=<?php echo $row['ban_id']?>">Active</a>

                    <?php
                }
       ?></td>


<td><a href="#deleteModal" data-id="<?php echo $row['ban_id']?>" 
data-bs-toggle="modal" class="delete btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i>
  </a></td>

			<td> <a href="banupdate.php?ban_id=<?php echo  $row['ban_id'];?>"><i id="i1" class="edit bi bi-pencil-square btn btn-primary shadow btn-xs sharp" 
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
  	<form method="post" enctype="multipart/form-data" id="addBannerForm">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h2 class="modal-title">ADD BANNER</h2>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
      </div>
    
      <div class="modal-body">
        <p class="lead text-center">
           <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-postage-fill"></i></span>
            <input type="text" name="ban_title" id="ban_title" class="form-control" placeholder="Banner Title" aria-label="ban_title" aria-describedby="basic-addon1">
          </div>

          <div class="input-group mb-3">
            <input class="form-control" type="file" name="ban_img" id="ban_img">
		</div>

      <div class="modal-footer">
        <button class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-outline-primary" type="submit" name="submit">Add</button>

      </div>

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

$errors = []; // Array to store validation errors

if(isset($_POST['submit'])) {
    // Validate Banner Title
    if(empty($_POST['ban_title'])) {
        $errors[] = "Banner Title is required";
    } else {
        $ban_title = $_POST['ban_title'];
    }

    // Validate Banner Image
    if(!isset($_FILES['ban_img']) || $_FILES['ban_img']['error'] === UPLOAD_ERR_NO_FILE) {
        $errors[] = "Banner Image is required";
    } else {
        $name = $_FILES['ban_img']['name'];
        $tempname = $_FILES['ban_img']['tmp_name'];
        $folderpath = "./images/".$name;

        if(move_uploaded_file($tempname, $folderpath)) {
            // Image uploaded successfully
        } else {
            $errors[] = "Failed to upload image";
        }
    }

    // If there are no validation errors, proceed with database insertion
    if(empty($errors)) {
        $qry = "INSERT INTO tbl_banner(ban_title, ban_img) VALUES ('$ban_title', '$folderpath')";
        $res = mysqli_query($con, $qry);

        if($res) {
            echo "<script>alert('Banner added successfully');</script>";
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
			url:"bandelete.php",
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