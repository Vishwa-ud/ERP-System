<?php
include 'db_config.php';

if(isset($_POST['search'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Fetch invoices within the date range
    $sql = "SELECT * FROM invoice WHERE `date` BETWEEN '$start_date' AND '$end_date'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Invoice Report</h1>
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
                    <th>Date</th>
                    <th>Time</th>
                    <th>Customer</th>
                    <th>Item Count</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($result) && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['invoice_no'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['time'] . "</td>";
                        echo "<td>" . $row['customer'] . "</td>";
                        echo "<td>" . $row['item_count'] . "</td>";
                        echo "<td>" . $row['amount'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No invoices found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
