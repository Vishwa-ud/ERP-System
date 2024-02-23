<?php
// Include your database connection file
include 'db_config.php';

// Check if customer ID is provided in the URL
if (isset($_GET['id'])) {
    $customerId = $_GET['id'];

    // Fetch customer details
    $sql = "SELECT * FROM customer WHERE id = $customerId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Update Customer</h1>
        <form method="post" action="">
            <input type="hidden" name="customer_id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($row['title']) ? $row['title'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" class="form-control" id="first-name" name="first_name" value="<?php echo isset($row['first_name']) ? $row['first_name'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="middle-name">Middle Name</label>
                <input type="text" class="form-control" id="middle-name" name="middle_name" value="<?php echo isset($row['middle_name']) ? $row['middle_name'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" class="form-control" id="last-name" name="last_name" value="<?php echo isset($row['last_name']) ? $row['last_name'] : ''; ?>" required>
            </div>
            <div class="form-group">
    <label for="contact-number">Contact Number</label>
    <input type="text" class="form-control" id="contact-number" name="contact_number" value="<?php echo isset($row['contact_no']) ? $row['contact_no'] : ''; ?>" required>
</div>
            <div class="form-group">
                <label for="district">District</label>
                <input type="text" class="form-control" id="district" name="district" value="<?php echo isset($row['district']) ? $row['district'] : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="update_customer">Update</button>
        </form>
    </div>
</body>
</html>
<?php
    } else {
        echo "Customer not found";
    }
} else {
    echo "Customer ID not provided";
}

// Handle update operation
if (isset($_POST['update_customer'])) {
    $customerId = $_POST['customer_id'];
    $title = $_POST['title'];
    $firstName = $_POST['first_name'];
    $middleName = $_POST['middle_name'];
    $lastName = $_POST['last_name'];
    $contactNumber = $_POST['contact_number'];
    $district = $_POST['district'];

    // Update customer in customer table
    $sql = "UPDATE customer SET title=?, first_name=?, middle_name=?, last_name=?, contact_no=?, district=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssi", $title, $firstName, $middleName, $lastName, $contactNumber, $district, $customerId);
    
if ($stmt->execute()) {
    // Redirect to viewcustomerlist.php with success message
    header("Location: viewcustomerlist.php?update_message=success");
    exit();
} else {
    // Redirect to viewcustomerlist.php with error message
    header("Location: viewcustomerlist.php?update_message=error");
    exit();
}
}

// Close the database connection
$conn->close();
?>
