<?php
include 'db_config.php';

// Insert item
if (isset($_POST['submit_item'])) {
    // Retrieve form data
    $itemCode = $_POST['item_code'];
    $itemName = $_POST['item_name'];
    $itemCategory = $_POST['item_category'];
    $itemSubcategory = $_POST['item_subcategory'];
    $quantity = $_POST['quantity'];
    $unitPrice = $_POST['unit_price'];

    // Insert into Item table
    $sqlItem = "INSERT INTO item (item_code, item_category, item_subcategory, item_name, quantity, unit_price)
                VALUES ('$itemCode', '$itemCategory', '$itemSubcategory', '$itemName', '$quantity', '$unitPrice')";

if ($conn->query($sqlItem) === TRUE) {
    // Redirect to viewitemlist.php with success message
    header("Location: viewitemlist.php?success=1");
    exit();

        // Insert into ItemCategory table if not already exists
        $sqlCategory = "INSERT INTO item_category (category) VALUES ('$itemCategory')
                        ON DUPLICATE KEY UPDATE category = category";
        $conn->query($sqlCategory);

        // Insert into ItemSubcategory table if not already exists
        $sqlSubcategory = "INSERT INTO item_subcategory (sub_category) VALUES ('$itemSubcategory')
                           ON DUPLICATE KEY UPDATE sub_category = sub_category";
        $conn->query($sqlSubcategory);

    } else {
        // Redirect to viewitemlist.php with error message
        header("Location: viewitemlist.php?error=1");
        exit();
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

    // Update item in item table
    $sqlItem = "UPDATE item SET item_code='$itemCode', item_name='$itemName', item_category='$itemCategory', item_subcategory='$itemSubcategory', quantity='$quantity', unit_price='$unitPrice' WHERE id='$itemId'";

    if ($conn->query($sqlItem) === TRUE) {
        echo "Record updated successfully";

        // Update item category in item_category table
        $sqlCategory = "INSERT INTO item_category (category) VALUES ('$itemCategory') ON DUPLICATE KEY UPDATE category = category";
        $conn->query($sqlCategory);

        // Update item subcategory in item_subcategory table
        $sqlSubcategory = "INSERT INTO item_subcategory (sub_category) VALUES ('$itemSubcategory') ON DUPLICATE KEY UPDATE sub_category = sub_category";
        $conn->query($sqlSubcategory);

    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Delete item
if (isset($_GET['delete_item'])) {
    $itemId = $_GET['delete_item'];

    // Fetch item details to get category and subcategory
    $sqlFetchItem = "SELECT * FROM item WHERE id='$itemId'";
    $resultItem = $conn->query($sqlFetchItem);
    $rowItem = $resultItem->fetch_assoc();

    // Delete item from item table
    $sqlDeleteItem = "DELETE FROM item WHERE id='$itemId'";

    if ($conn->query($sqlDeleteItem) === TRUE) {
        echo "Record deleted successfully";

        // Delete category from item_category table if not used by any other item
        $sqlCheckCategory = "SELECT * FROM item WHERE item_category = '{$rowItem['item_category']}' AND id != '$itemId'";
        $resultCategory = $conn->query($sqlCheckCategory);
        if ($resultCategory->num_rows == 0) {
            $sqlDeleteCategory = "DELETE FROM item_category WHERE category='{$rowItem['item_category']}'";
            $conn->query($sqlDeleteCategory);
        }

        // Delete subcategory from item_subcategory table if not used by any other item
        $sqlCheckSubcategory = "SELECT * FROM item WHERE item_subcategory = '{$rowItem['item_subcategory']}' AND id != '$itemId'";
        $resultSubcategory = $conn->query($sqlCheckSubcategory);
        if ($resultSubcategory->num_rows == 0) {
            $sqlDeleteSubcategory = "DELETE FROM item_subcategory WHERE sub_category='{$rowItem['item_subcategory']}'";
            $conn->query($sqlDeleteSubcategory);
        }

    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch all items
$sql = "SELECT * FROM item";
$result = $conn->query($sql);

// Check if there are any items
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Item Code: " . $row["item_code"] . " - Item Name: " . $row["item_name"] . "<br>";
    }
} else {
    echo "0 results";
}
?>
