<?php
include 'db_config.php';

// Update or Delete Customer
if(isset($_POST['action']) && isset($_POST['customer_id'])) {
    $action = $_POST['action'];
    $customer_id = $_POST['customer_id'];
    
    if($action == 'update') {
        // Redirect to update page with customer ID
        header("Location: updatecustomer.php?id=$customer_id");
        exit();
    } elseif($action == 'delete') {
        // Delete the customer
        $sql = "DELETE FROM customer WHERE id='$customer_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}


// Check if a message is present in the URL
if(isset($_GET['update_message'])) {
    $update_message = $_GET['update_message'];
    
    // Display success or error message based on the message received
    if($update_message == 'success') {
        echo '<div class="alert alert-success" role="alert">Customer updated successfully!</div>';
    } elseif($update_message == 'error') {
        echo '<div class="alert alert-danger" role="alert">Failed to update customer. Please try again.</div>';
    }
}


// Check if a message is present in the URL
if(isset($_GET['message'])) {
    $message = $_GET['message'];
    
    // Display success or error message based on the message received
    if($message == 'success') {
        echo '<div class="alert alert-success" role="alert">Customer added successfully!</div>';
    } elseif($message == 'error') {
        echo '<div class="alert alert-danger" role="alert">Failed to add customer. Please try again.</div>';
    }
}

// Fetch all customers
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Customer List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Contact Number</th>
                    <th>District</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['middle_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['contact_no']; ?></td>
                        <td><?php echo $row['district']; ?></td>
                        <td>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="customer_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="action" value="update">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="customer_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="home.html" class="btn btn-primary">Go Back</a>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
