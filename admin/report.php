<?php include('include.php'); ?>

<main id="main" class="main">
    <div class="col-12">
        <div class="pagetitle">
            <h1>REPORT TABLE</h1>
        </div><!-- End Page Title -->

        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="card filter-card">
                    <div class="mb-2 mt-2 ml-2">
                        <form method="get">
                            <label for="statusFilter">Filter by Status:</label>
                            <select id="status" name="status" class="form-select">
                                <option value="">All</option>
                                <option value="1">COD</option>
                                <option value="2">ONLINE</option>
                                <option value="4">CANCEL</option>
                            </select>
                            <button type="submit" class="btn btn-primary ml-2">Apply</button>
                        </form>
                    </div>
                </div>

                <table class="table table-bordered datatable mt-4" id="datatableid">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>USER NAME</th>
                            <th>PNAME</th>
                            <th>PPIC</th>
                            <th>DATE</th>
                            <th>TOTAL AMOUNT</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $con = mysqli_connect("localhost", "root", "", "furniture");

                        // Pagination variables
                        $limit = 5; // Number of records per page
                        $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
                        $start = ($page - 1) * $limit; // Starting row number for query

                        // Filter by status
                        $status_filter = isset($_GET['status']) ? $_GET['status'] : '';
                        $status_condition = '';
                        if ($status_filter !== '') {
                            $status_condition = "AND status = '$status_filter'";
                        }

                        $query = "SELECT * FROM tbl_order WHERE status>0 $status_condition LIMIT $start, $limit";
                        $res = mysqli_query($con, $query);
                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            $serialNumber = $start + 1; // Initialize serial number counter
                            while ($row = mysqli_fetch_assoc($res)) {
                                $uid= $row['uid'];

                                $q="SELECT * FROM tbl_user WHERE user_id=$uid";
                                $result=mysqli_query($con,$q);
                                $r1=mysqli_fetch_assoc($result);

                                echo "<tr>";
                                echo "<td>" . $serialNumber++ . "</td>"; // Display serial number
                                echo "<td>" . $r1['user_name'] . "</td>";
                                echo "<td>" . $row['pname'] . "</td>";
                                echo "<td> <img src='" . $row['ppic'] . "' class='img-thumbnail' height='80' width='80'></td>";
                                echo "<td>" . $row['date'] . "</td>";
                                echo "<td>" . $row['total_amount'] . "</td>";
                                if ($row['status'] == "1") {
                                    echo "<td><span class='badge badge-success'>COD</span></td>";
                                } else if ($row['status'] == "2") {
                                    echo "<td><span class='badge badge-info'>Online</span></td>";
                                } else if ($row['status'] == "4") {
                                    echo "<td><span class='badge badge-danger'>cancel</span></td>";
                                }
                                ?>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='7'>NO data Found</td></tr>";
                        }

                        // Pagination links
                        $query = "SELECT COUNT(*) as count FROM tbl_order WHERE status>0 $status_condition";
                        $result = mysqli_query($con, $query);
                        $data = mysqli_fetch_assoc($result);
                        $total_pages = ceil($data['count'] / $limit);
                        ?>
                    </tbody>
                </table>

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>&status=<?php echo $status_filter; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>
