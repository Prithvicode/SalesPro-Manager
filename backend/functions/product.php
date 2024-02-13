<!-- <?php

include '../db/dbconfig.php';
// Allow cross-origin resource sharing (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Main router function
function routeRequest($conn) {
    $method = $_SERVER['REQUEST_METHOD'];
    
    switch ($method) {
        case 'GET':
            handleGETRequest($conn);
            break;
        case 'POST':
            handlePOSTRequest();
            break;
        case 'PUT':
            handlePUTRequest();
            break;
        case 'DELETE':
            handleDELETERequest();
            break;
        default:
            // Handle unsupported methods
            http_response_code(405);
            echo "Method Not Allowed";
            break;
    }
}

// Call the router function
routeRequest($conn);

// Function to handle GET requests
function handleGETRequest($conn) {
    // Check the URL and call the appropriate function
    $path = $_SERVER['REQUEST_URI'];
    echo $path;
    if ($path === '/InventoryAndSalesManagement/backend/functions/product.php/products') {
        getAllProducts($conn);
    } elseif (preg_match('/\/InventoryAndSalesManagement/backend/functions/product.php/products\/(\d+)/', $path, $matches)) {
        $productId = $matches[1];
        getOneProduct($productId);
    } else {
        // Handle invalid URL
        http_response_code(404);
        echo "Not Found";
    }
}

function getAllProducts($conn){
    // return array of products in json 
    $products  = [];

    $allProducts_query = "SELECT * from products";

    $result = mysqli_query($conn, $allProducts_query);
    // if($result){
    //     $num = mysqli_num_rows($result);
    //     echo $num;
    // }
    if(mysqli_num_rows($result) > 0){
        while( $row = mysqli_fetch_assoc($result)){
           array_push($products, $row); // append
        }
        echo json_encode($products);
    } else {
        echo json_encode(["Error" => "There are no Products"]);
    }
}

function getOneProduct($conn,$productId){
    // return a product
    $product = [];

    $product_query = "SELECT * from products where ProductID = $productId";
}

// POST
function handlePOSTRequest(){
    // Your code to handle POST requests
}

// PUT
function handlePUTRequest(){
    // Your code to handle PUT requests
}

// DELETE
function handleDELETERequest(){
    // Your code to handle DELETE requests
}

?> -->
