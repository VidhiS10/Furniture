<?php
include('include.php');
?>

<main id="main" class="main">

<?php
$con=mysqli_connect("localhost","root","","furniture");
$arr=array();

if(isset($_POST['btnSearch'])){
    $search=$_POST['search'];


$query="SELECT * FROM tbl_sub_category WHERE sub_cat_name LIKE '%$search%'";
$res=mysqli_query($con,$query);

$count=mysqli_num_rows($res);

if ($count>0){
	while($row=mysqli_fetch_assoc($res)){
        array_push($arr,$row);

    }
}

}
?>


<div class="container mt-3">
<div class="row">
	
<?php

foreach($arr as $item){
?>


<div class="col-3">


<div class="card mb-5">
  <img class="card-img-top" src="<?php echo $item['sub_cat_pic1'] ?>" height="200" width="300" alt="Card image cap">
  <div class="card-body ">
    <h5 class="card-title"><?php echo $item['sub_cat_name'] ?></h5>
    <p class="card-text"><strong>Description:</strong> <?php echo $item['sub_cat_description'] ?></p>
    <p class="card-text"><strong>Discount:</strong> <?php echo $item['sub_cat_discount'] ?></p>
    <p class="card-text"><strong>Price:</strong> <?php echo $item['sub_cat_price'] ?></p>


    <a href="sub_catview.php?sub_cat_id=<?php echo $item['sub_cat_id'];?>"  class="view btn btn-warning shadow btn-xs sharp"><i class="fa-solid fa-eye"></i></a>
    <a href="sub_catdelete.php?sub_cat_id=<?php echo $item['sub_cat_id'];?>"  class=" delete btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
    <!-- <i class='bi bi-trash text-danger' data-bs-toggle='tooltip' title='Delete'></i>Delete</a>	 -->
    <a href="sub_catupdate.php?sub_cat_id=<?php echo $item['sub_cat_id'];?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
    <!-- <i class='bi bi-pencil-square text-primary' data-bs-toggle='tooltip' title='update' ></i>Update</a> -->


  </div>
</div>

</div>
<?php
}
?>

</main>
<?php
include('footer.php');
?>