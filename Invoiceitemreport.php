<?php
include 'db_config.php';

if(isset($_POST['search'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Fetch invoice items within the date range
    $sql = "SELECT i.invoice_number, i.invoice_date, i.customer, ii.item_name, ii.item_code, ii.item_category, ii.unit_price 
            FROM invoice_items ii 
            INNER JOIN invoices i ON ii.invoice_id = i.id 
            WHERE i.invoice_date BETWEEN '$start_date' AND '$end_date'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Item Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Invoice Item Report</h1>
        <!-- Search Form -->
        <form action="" method="POST" class="mb-3">
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <button type="submit" class="btn btn-primary" name="search">Search</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Invoice Number</th>
                    <th>Invoice Date</th>
                    <th>Customer Name</th>
                    <th>Item Name</th>
                    <th>Item Code</th>
                    <th>Item Category</th>
                    <th>Unit Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($result) && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['invoice_number'] . "</td>";
                        echo "<td>" . $row['invoice_date'] . "</td>";
                        echo "<td>" . $row['customer'] . "</td>";
                        echo "<td>" . $row['item_name'] . "</td>";
                        echo "<td>" . $row['item_code'] . "</td>";
                        echo "<td>" . $row['item_category'] . "</td>";
                        echo "<td>" . $row['unit_price'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No invoice items found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
