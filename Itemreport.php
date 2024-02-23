<?php
include 'db_config.php';

// Fetch item report details
$sql = "SELECT item_name, item_category, item_subcategory, SUM(quantity) AS total_quantity 
        FROM item 
        GROUP BY item_name";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Item Report</h1>
        <button onclick="printTable()" class="btn btn-primary">Print and Download</button>
        <table id="dataTable" class="table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Item Category</th>
                    <th>Item Subcategory</th>
                    <th>Total Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["item_name"] . "</td>";
                        echo "<td>" . $row["item_category"] . "</td>";
                        echo "<td>" . $row["item_subcategory"] . "</td>";
                        echo "<td>" . $row["total_quantity"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No items found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="home.html" class="btn btn-primary">Go Back</a>
    </div>

    <script>
        function printTable() {
            // Open print dialog
            window.print();
        }
    </script>
</body>
</html>
