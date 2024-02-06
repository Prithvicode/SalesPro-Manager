<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="productName">Product Name:</label><br>
        <input type="text" id="productName" name="productName" required><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br>

        <label for="sku">SKU:</label><br>
        <input type="text" id="sku" name="sku" required><br>

        <label for="productionTime">Production Time (Days):</label><br>
        <input type="number" id="productionTime" name="productionTime" required><br>

        <label for="costPrice">Cost Price:</label><br>
        <input type="number" id="costPrice" name="costPrice" step="0.01" required><br>

        <label for="sellingPrice">Selling Price:</label><br>
        <input type="number" id="sellingPrice" name="sellingPrice" step="0.01" required><br>

        <label for="inventoryLevel">Inventory Level:</label><br>
        <input type="number" id="inventoryLevel" name="inventoryLevel" required><br>

        <label for="productImage">Product Image:</label><br>
        <input type="file" id="productImage" name="productImage"><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
