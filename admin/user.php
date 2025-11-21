<?php
include('include.php');
?>



  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->

<!-- Page Heading -->
<h1 class="h3 mb-4 text-black">User Table</h1>

	<div class="row justify-content-center">
		<div class="col-lg-12">
<table class="table table-grey text-black">
	<thead>
			
		<tr>

			<th>sr. No.</th>
			<th>User ID</th>
			<th>User Name</th>
			<th>User Email</th>
			<th>User Phone</th>
			<th>User Img</th>
			
		</tr>
	</thead>
    <tbody>
        <b class="text-primary">


    <?php 
$con = mysqli_connect("localhost","root","","furniture");

$query="SELECT * FROM tbl_user order by user_id";

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
	echo "<td>".$row['user_id']."</td>";
	echo "<td>".$row['user_name']."</td>";
	echo "<td>".$row['user_email']."</td>";
	echo "<td>".$row['user_phone']."</td>";
	if(strcmp($row['user_pic'],""	)==0){
		echo "<td> <img src='../api/img/profile.png' class='img-circle' height='100' width='100'></td>";

	}else{
		echo "<td> <img src='../api/img/" . $row['user_pic'] . "' class='img-circle' height='100' width='100'></td>";

	}
	?>

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



<?php
include('footer.php');
?>








