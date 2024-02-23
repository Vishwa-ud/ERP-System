<?php
include 'db_config.php';

// Insert customer
if (isset($_POST['submit_customer'])) {
    $title = $_POST['title'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $contactNumber = $_POST['contact_number'];
    $district = $_POST['district'];

    $sql = "INSERT INTO customers (title, first_name, last_name, contact_number, district)
            VALUES ('$title', '$firstName', '$lastName', '$contactNumber', '$district')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Update customer
if (isset($_POST['update_customer'])) {
    $customerId = $_POST['customer_id'];
    $title = $_POST['title'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $contactNumber = $_POST['contact_number'];
    $district = $_POST['district'];

    $sql = "UPDATE customers SET title='$title', first_name='$firstName', last_name='$lastName',
            contact_number='$contactNumber', district='$district' WHERE id='$customerId'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Delete customer
if (isset($_GET['delete_customer'])) {
    $customerId = $_GET['delete_customer'];

    $sql = "DELETE FROM customers WHERE id='$customerId'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch all customers
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
?>
