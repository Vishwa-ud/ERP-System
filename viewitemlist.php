<?php
// Include your database connection file
include 'db_config.php';

// Check if item deletion is requested
if(isset($_GET['id'])) {
    $itemId = $_GET['id'];

    // Attempt to delete the item from the database
    $sqlDelete = "DELETE FROM item WHERE id = '$itemId'";
    if($conn->query($sqlDelete) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Item deleted successfully.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error deleting item: " . $conn->error . "</div>";
    }
}
// Check for message in URL
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    echo "<div class='alert alert-success' role='alert'>$message</div>";
}

// Check for error in URL
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    echo "<div class='alert alert-danger' role='alert'>$error</div>";
}

// Fetch all items
$sql = "SELECT * FROM item";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Item List</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>View Item List</h1>
        <?php
        // Display messages after deletion attempt
        if(isset($_GET['id'])) {
            if($conn->query($sqlDelete) === TRUE) {
                echo "<div class='alert alert-success' role='alert'>Item deleted successfully.</div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>Error deleting item: " . $conn->error . "</div>";
            }
        }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Item Category</th>
                    <th>Item Subcategory</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["item_code"] . "</td>";
                        echo "<td>" . $row["item_name"] . "</td>";
                        echo "<td>" . $row["item_category"] . "</td>";
                        echo "<td>" . $row["item_subcategory"] . "</td>";
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "<td>" . $row["unit_price"] . "</td>";
                        echo "<td>";
                        echo "<a href='update_item.php?id=" . $row["id"] . "' class='btn btn-primary'>Update</a>";
                        echo "<a href='viewitemlist.php?id=" . $row["id"] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this item?\")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No items found</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
