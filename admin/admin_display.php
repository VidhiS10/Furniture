<?php
include('include.php');
?>

  
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
         

<!-- Page Heading -->
<h1 class="h3 mb-4 text-black">Admin Table</h1>

	<div class="row justify-content-center">
		<div class="col-lg-12">
<table class="table table-grey text-black">
	<thead>
			
		<tr>
			<th>Admin ID</th>
			<th>Admin Name</th>
			<th>Admin Email</th>
			<th>Admin Mobile</th>
			<th>Delete</th>
			
		</tr>
	</thead>
    <tbody>
        <b class="text-primary">


    <?php 
$con = mysqli_connect("localhost","root","","furniture");

$query="SELECT * FROM tbl_admin order by admin_id";

$res=mysqli_query($con,$query);

$count=mysqli_num_rows($res);

if ($count>0){
	while($row=mysqli_fetch_assoc($res)){
		echo"<tr>";
	echo "<td>".$row['admin_id']."</td>";
	echo "<td>".$row['admin_name']."</td>";
	echo "<td>".$row['admin_email']."</td>";
	echo "<td>".$row['admin_mobile']."</td>";
	?>


<td><a href="#deleteModal" data-id="<?php echo $row['admin_id']?>" 
data-bs-toggle="modal" class="delete btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i>
  </a></td>

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
include('footer.php');
?>


<script type="text/javascript">
	$(document).on("click",".delete",function(){
		var id=$(this).attr("data-id");
		$('#id_d').val(id);
	});

	$(document).on("click","#btnDelete",function(){
		$.ajax({
			url:"admin_display_delete.php",
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