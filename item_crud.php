<?php
include 'db_config.php';

// Insert item
if (isset($_POST['submit_item'])) {
    $itemCode = $_POST['item_code'];
    $itemName = $_POST['item_name'];
    $itemCategory = $_POST['item_category'];
    $itemSubcategory = $_POST['item_subcategory'];
    $quantity = $_POST['quantity'];
    $unitPrice = $_POST['unit_price'];

    $sql = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price)
            VALUES ('$itemCode', '$itemName', '$itemCategory', '$itemSubcategory', '$quantity', '$unitPrice')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

// Update item
if (isset($_POST['update_item'])) {
    $itemId = $_POST['item_id'];
    $itemCode = $_POST['item_code'];
    $itemName = $_POST['item_name'];
    $itemCategory = $_POST['item_category'];
    $itemSubcategory = $_POST['item_subcategory'];
    $quantity = $_POST['quantity'];
    $unitPrice = $_POST['unit_price'];

    $sql = "UPDATE item SET item_code='$itemCode', item_name='$itemName', item_category='$itemCategory',
            item_subcategory='$itemSubcategory', quantity='$quantity', unit_price='$unitPrice' WHERE id='$itemId'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Delete item
if (isset($_GET['delete_item'])) {
    $itemId = $_GET['delete_item'];

    $sql = "DELETE FROM item WHERE id='$itemId'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch all items
$sql = "SELECT * FROM item";
$result = $conn->query($sql);
?>
