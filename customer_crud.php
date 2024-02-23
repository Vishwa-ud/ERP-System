<?php
include 'db_config.php';

// Insert customer
if (isset($_POST['submit_customer'])) {
    $title = $_POST['title'];
    $firstName = $_POST['first_name'];
    $middleName = $_POST['middle_name']; // added middle name
    $lastName = $_POST['last_name'];
    $contactNumber = $_POST['contact_number'];
    $district = $_POST['district'];

    $sql = "INSERT INTO customer (title, first_name, middle_name, last_name, contact_no, district)
            VALUES ('$title', '$firstName', '$middleName', '$lastName', '$contactNumber', '$district')";

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
    $middleName = $_POST['middle_name']; // added middle name
    $lastName = $_POST['last_name'];
    $contactNumber = $_POST['contact_number'];
    $district = $_POST['district'];

    $sql = "UPDATE customer SET title='$title', first_name='$firstName', middle_name='$middleName',
            last_name='$lastName', contact_no='$contactNumber', district='$district' WHERE id='$customerId'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Delete customer
if (isset($_GET['delete_customer'])) {
    $customerId = $_GET['delete_customer'];

    $sql = "DELETE FROM customer WHERE id='$customerId'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch all customers
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);
?>
