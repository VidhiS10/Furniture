<?php
include('include.php');

$con = mysqli_connect("localhost", "root", "", "furniture");
$id=$_GET['sub_cat_id'];

// Check if sub_cat_id is provided in the URL
if(isset($_GET['sub_cat_id'])) {
    $id = $_GET['sub_cat_id'];

    // Prepare and execute the query to fetch subcategory details
    $query = "SELECT * FROM tbl_sub_category WHERE sub_cat_id = ?";
    $stmt = mysqli_prepare($con, $query);
    
    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Get the result
        $res = mysqli_stmt_get_result($stmt);
        
        // Fetch the row
        $row = mysqli_fetch_assoc($res);
    } else {
        // Handle the case where the statement preparation failed
        echo "Error: " . mysqli_error($con);
    }
}

// Close database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco-Delicous</title>
    <link rel="apple-touch-icon" sizes="76x76" href="images/lg.png">
    <link rel="icon" type="image/png" href="images/lg.png">
    <link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-img {
            width: 400px;
        }

        .product-info {
            padding: 20px;
            background-color: #f8f9fa; /* Light gray background */
            border-radius: 10px;
        }

        .product-info h1 {
            margin-top: 0;
            font-family: 'Playfair Display', serif; /* Use Playfair Display font */
            color: #343a40; /* Dark gray color */
        }

        .product-info p {
            margin-top: 10px;
            font-size: 18px;
            color: #6c757d; /* Medium gray color */
        }

        .product-price-btn button {
            margin-top: 20px;
            background-color: #007bff; /* Blue button */
            color: #fff; /* White text */
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .product-price-btn button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="product-img">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php for($i = 1; $i <= 4; $i++) : ?>
                                <?php if(!empty($row['sub_cat_pic'.$i])) : ?>
                                    <div class="carousel-item <?php if($i == 1) echo 'active'; ?>">
                                        <img class="d-block w-100" src="<?= $row['sub_cat_pic'.$i] ?>" alt="Product Image">
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="product-info">
                    <?php if(!empty($row)) : ?>
                        <h1><?= $row['sub_cat_name'] ?></h1>
                        <p><strong>Description:</strong> <?= $row['sub_cat_description'] ?></p>
                        <p><strong>Discount:</strong> <?= $row['sub_cat_discount'] ?>%</p>
                        <p><strong>Color:</strong> <?= $row['sub_cat_color'] ?></p>
                        <p><strong>Rating:</strong> <?= $row['sub_cat_product_rating'] ?></p>
                        <p><strong>Dimension:</strong> <?= $row['sub_cat_dimention'] ?></p>
                        <p><strong>Weight:</strong> <?= $row['sub_cat_weight'] ?></p>
                        <p><strong>Primary Material:</strong> <?= $row['sub_cat_primary_material'] ?></p>
                        <p><strong>SKU:</strong> <?= $row['sub_cat_sku'] ?></p>
                        <p><strong>Specification:</strong> <?= $row['sub_cat_specification'] ?></p>
                        <p><strong>Warranty:</strong> <?= $row['sub_cat_warenty'] ?></p>
                        <p><strong>Price:</strong> <?= $row['sub_cat_price'] ?>₹</p>
                        <div class="product-price-btn">
                            <button type="button" class="btn btn-primary" onclick="window.location.href='sub_category.php';">Back</button>
                        </div>
                    <?php else : ?>
                        <p>No product found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
