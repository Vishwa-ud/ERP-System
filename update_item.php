<?php
// Include your database connection file
include 'db_config.php';

// Check if item ID is provided in the URL
if (isset($_GET['id'])) {
    $itemId = $_GET['id'];

    // Fetch item details
    $sql = "SELECT * FROM item WHERE id = $itemId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Update Item</h1>
        <form method="post" action="">
            <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="item-code">Item Code</label>
                <input type="text" class="form-control" id="item-code" name="item_code" value="<?php echo $row['item_code']; ?>" required>
            </div>
            <div class="form-group">
                <label for="item-name">Item Name</label>
                <input type="text" class="form-control" id="item-name" name="item_name" value="<?php echo $row['item_name']; ?>" required>
            </div>
            <!-- Include other fields as per your item structure -->
            <div class="form-group">
                <label for="item-category">Item Category</label>
                <input type="text" class="form-control" id="item-category" name="item_category" value="<?php echo $row['item_category']; ?>" required>
            </div>
            <div class="form-group">
                <label for="item-subcategory">Item Subcategory</label>
                <input type="text" class="form-control" id="item-subcategory" name="item_subcategory" value="<?php echo $row['item_subcategory']; ?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" required>
            </div>
            <div class="form-group">
                <label for="unit-price">Unit Price</label>
                <input type="number" class="form-control" id="unit-price" name="unit_price" value="<?php echo $row['unit_price']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="update_item">Update</button>
        </form>
    </div>
</body>
</html>
<?php
    } else {
        echo "Item not found";
    }
} else {
    echo "Item ID not provided";
}

// Handle update operation
if (isset($_POST['update_item'])) {
    $itemId = $_POST['item_id'];
    $itemCode = $_POST['item_code'];
    $itemName = $_POST['item_name'];
    $itemCategory = $_POST['item_category'];
    $itemSubcategory = $_POST['item_subcategory'];
    $quantity = $_POST['quantity'];
    $unitPrice = $_POST['unit_price'];

    // Update item in item table
    $sql = "UPDATE item SET item_code=?, item_name=?, item_category=?, item_subcategory=?, quantity=?, unit_price=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssidi", $itemCode, $itemName, $itemCategory, $itemSubcategory, $quantity, $unitPrice, $itemId);
    
    if ($stmt->execute()) {
        // Redirect to viewitemlist.php with success message
        header("Location: viewitemlist.php?message=Item updated successfully");
        exit();
    } else {
        // Redirect to viewitemlist.php with error message
        header("Location: viewitemlist.php?error=Error updating item: " . $conn->error);
        exit();
    }
}

// Close the database connection
$conn->close();
?>