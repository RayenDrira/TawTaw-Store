<?php

include 'connexion.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo '<p class="Error-php">Please log in to view your cart.</p>';
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch the user's cart items
$sql = "
SELECT 
    p.product_id,
    pv.variation_id, -- Include the variation_id
    p.name AS product_name,
    p.company,
    p.description,
    pv.price,
    pv.color,
    pv.quantity AS stock_quantity,
    ci.quantity AS cart_quantity,
    pi.image_url
FROM cart ci
JOIN product_variation pv ON ci.variation_id = pv.variation_id
JOIN products p ON pv.product_id = p.product_id
LEFT JOIN product_images pi ON pv.variation_id = pi.variation_id
WHERE ci.user_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        $colorAbbreviation = ucfirst(strtolower(substr($product['color'], 0, 3)));
        $isFavourite = false;
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            
            $favSql = "SELECT * FROM favourates WHERE user_id = ? AND variation_id = ?";
            $favStmt = $conn->prepare($favSql);
            $favStmt->bind_param('ii', $user_id, $product['variation_id']);
            $favStmt->execute();
            $favResult = $favStmt->get_result();
            $isFavourite =  $favResult->num_rows > 0;
            $favStmt->close();
        }
        echo '<div class="container">
            <div class="product-image"><img src="../' . htmlspecialchars($product['image_url']) . '" alt="product-image"></div>
            <div class="cart-details">
                <div class="button-holder">
                    <h3>' . htmlspecialchars($product['product_name']) . ' (' . htmlspecialchars($colorAbbreviation) . ')</h3>
<img 
                        class="heart" 
                        src="../Images/Icons/' . ($isFavourite ? 'heart_on.svg' : 'heart.svg') . '" 
                        onclick="toggleFavourite(this, ' . htmlspecialchars($product['variation_id']) . ')" 
                        data-favourite="' . ($isFavourite ? 'true' : 'false') . '"
                    >                </div>
                <div>
                    <p class="cart-details-details" id="stock">' . ($product['stock_quantity'] > 0 ? 'In Stock' : '<span style="color: red;">Out of Stock</span>') . '</p>
                    <p class="cart-details-details"><span>Color :</span> ' . htmlspecialchars($product['color']) . '</p>
                    <p class="cart-details-details"><span>Quantity :</span> ' . htmlspecialchars($product['cart_quantity']) . '</p>
                </div>
                <div class="button-holder">
                    <button class="btx-blue" id="product" onclick="window.location.href=\'../html/product.php?variation_id=' . htmlspecialchars($product['variation_id']) . '\'">More Details</button>
                    <button class="btx-red-reverse" onclick="deleteFromCart(' . htmlspecialchars($product['variation_id']) . ')">Delete</button>
                </div>
            </div>
            <div class="cart-options">
                <div class="button-holder">
                    <h3>Price</h3>
                    <input type="checkbox" class="select-pay">
                </div>
                <p><span>' . number_format($product['price'], 2) . ' TND</span></p>
                <div>
                    <input type="number" value="' . htmlspecialchars($product['cart_quantity']) . '" min="1" max="' . htmlspecialchars($product['stock_quantity']) . '" onchange="updateCartQuantity(' . htmlspecialchars($product['product_id']) . ', this.value)">
                    <button class="btx-red-reverse" id="buy">Buy</button>
                </div>
            </div>
        </div>';
    }
} else {
    echo '<p>Your cart is empty.</p>';
}

$stmt->close();
$conn->close();
?>