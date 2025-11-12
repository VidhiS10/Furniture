<?php
include('include.php');
?>



  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->

<!-- Page Heading -->
<h1 class="h3 mb-4 text-black">Review Table</h1>

	<div class="row justify-content-center">
		<div class="col-lg-12">
<table class="table table-grey text-black">
	<thead>
			
		<tr>
			<th>Review ID</th>
			<th>User ID</th>
			<th>Sub Category ID</th>
			<th>User Password</th>
			<th>Review Title</th>
			<th>Review Description</th>
			<th>Review Star</th>
			
		</tr>
	</thead>
    <tbody>
        <b class="text-primary">


    <?php 
$con = mysqli_connect("localhost","root","","furniture");

$query="SELECT * FROM tbl_review order by review_id";

$res=mysqli_query($con,$query);

$count=mysqli_num_rows($res);

if ($count>0){
	while($row=mysqli_fetch_assoc($res)){
		echo"<tr>";
	echo "<td>".$row['review_id']."</td>";
	echo "<td>".$row['user_id']."</td>";
	echo "<td>".$row['sub_cat_id']."</td>";
	echo "<td>".$row['review_title']."</td>";
	echo "<td>".$row['review_description']."</td>";
	echo "<td>".$row['review_star']."</td>";
	
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








