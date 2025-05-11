<?php

include '../php/connexion.php';

if (!isset($_GET['variation_id'])) {
    echo '<p>Variation not found.</p>';
    exit;
}

$variation_id = intval($_GET['variation_id']); 


$productSql = "SELECT product_id FROM product_variation WHERE variation_id = ?";
$productStmt = $conn->prepare($productSql);
$productStmt->bind_param('i', $variation_id);
$productStmt->execute();
$productResult = $productStmt->get_result();

if ($productResult->num_rows === 0) {
    echo '<p>Invalid variation selected.</p>';
    exit;
}

$productRow = $productResult->fetch_assoc();
$product_id = $productRow['product_id'];
$productStmt->close();


$sql = "
SELECT 
    pv.variation_id,
    pv.storage,
    pv.color,
    pv.price,
    pv.quantity,
    pi.image_url,
    p.name AS product_name,
    p.company,
    p.description
FROM product_variation pv
JOIN products p ON pv.product_id = p.product_id
LEFT JOIN product_images pi ON pv.variation_id = pi.variation_id
WHERE pv.product_id = ?
";

$variations = [];
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $variations[] = $row; 
    }
} else {
    echo '<p>No variations found for this product.</p>';
    exit;
}

$stmt->close();
$conn->close();


$uniqueStorageOptions = array_unique(array_column($variations, 'storage'));
$uniqueColorOptions = array_unique(array_column($variations, 'color'));

echo '<script>const variations = ' . json_encode($variations) . ';</script>';

function generateQuantityOptions($quantity)
{
    $options = '';
    for ($i = 1; $i <= $quantity; $i++) {
        $options .= '<option value="' . $i . '">Quantity: ' . $i . '</option>';
    }
    return $options;
}


$selectedVariation = null;
foreach ($variations as $variation) {
    if ($variation['variation_id'] == $variation_id) {
        $selectedVariation = $variation;
        break;
    }
}

if (!$selectedVariation) {
    $selectedVariation = $variations[0];
}


if (!empty($variations)) {
    $product = $selectedVariation;
    echo '
<div class="main-card">
    <h3 class="chemin">Home >> Shop >> ' . htmlspecialchars($product['company']) . ' >> 
        <span>' . htmlspecialchars($product['product_name']) . '</span>
    </h3>
    <div class="container">
        <div class="left-product">
            <div class="image-container">
                <img src="../' . htmlspecialchars($product['image_url']) . '" alt="Product Image" id="main-img">
            </div>
            <div class="button-holder">
                <svg width="29" height="36" viewBox="0 0 29 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2.14368 21.241C-0.278165 19.6631 -0.278166 16.1162 2.14368 14.5383L22.7164 1.13401C25.3772 -0.599632 28.9 1.30967 28.9 4.4854V31.2939C28.9 34.4696 25.3772 36.3789 22.7164 34.6453L2.14368 21.241Z"
                        fill="#FF2330" /> 
                </svg>
                <div class="image-holder">
                    <img src="../' . htmlspecialchars($product['image_url']) . '" alt="Product Image" class="side-img">
                </div>
                <div class="image-holder">
                    <img src="../' . htmlspecialchars($product['image_url']) . '" alt="Product Image" class="side-img">
                </div><div class="image-holder">
                    <img src="../' . htmlspecialchars($product['image_url']) . '" alt="Product Image" class="side-img">
                </div>
                <svg width="30" height="36" viewBox="0 0 30 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M27.3896 14.5383C29.8115 16.1162 29.8115 19.6631 27.3896 21.241L6.81694 34.6453C4.15617 36.3789 0.633326 34.4696 0.633326 31.2939V4.4854C0.633326 1.30967 4.15617 -0.599634 6.81694 1.13401L27.3896 14.5383Z" fill="#FF2330"></path>
                </svg>
            </div>
        </div>
        <div class="center-product">
            <div class="top">
                <div class="button-holder">
                    <h2>' . htmlspecialchars($product['product_name']) . '</h2>
                    <img class="heart" src="..\Images\Icons\heart_on.svg" onclick="toggleHeart(this)">
                </div>
                <p class="product-price" >' . number_format($product['price'], 2) . ' TND</p>
                <p>' . htmlspecialchars($product['description']) . '</p>
                <div class="button-holder">';
    $nonEmptyStorageOptions = array_filter($uniqueStorageOptions, function ($s) {
        return trim($s) !== '';
    });
    if (!empty($nonEmptyStorageOptions)) {
      
        foreach ($nonEmptyStorageOptions as $storage) {
            echo '<button class="choice" onclick="selectStorage(\'' . htmlspecialchars($storage) . '\')">' . htmlspecialchars($storage) . '</button>';
        }
        echo '</div>
                        <hr id="hr">
                        <div class="button-holder">';
    }
    foreach ($uniqueColorOptions as $color) {
        echo '<button class="choice" onclick="selectColor(\'' . htmlspecialchars($color) . '\')">' . htmlspecialchars($color) . '</button>';
    }

    echo '</div>
            </div>
            <div class="bottom">
                <div class="button-holder">
                    <p><span>Hot </span>right <span>now!</span></p>
                    <p><span>Highly </span>Rated</p>
                    <p><span>Low </span>Returns</p>
                </div>
                <div class="button-holder">
                    <button class="btx-red">Rate Now</button>
                    <div class="rating">';

    for ($i = 0; $i < 5; $i++) {
        echo '<svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.5 0L15.3064 8.63729H24.3882L17.0409 13.9754L19.8473 22.6127L12.5 17.2746L5.15268 22.6127L7.95911 13.9754L0.611794 8.63729H9.69357L12.5 0Z" fill="#FF2330" />
                              </svg>';
    }

    echo '<p>10</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-product">
            <div class="top">
                <h2 class="product-price" >' . number_format($product['price'], 2) . ' TND</h2>
                <p><span>Free </span> Shipping in <span> Tunisia</span></p>
                <p>Delivery on Tuesday, November 26</p>
                <p><span>Only ' . $product['quantity'] . '</span> left in stock - order <span>soon.</span></p>
                <p>Gift receipt included for easy returns</p>
            </div>
            <div class="bottom">
                <select name="quantity" id="quantity">
                    ' . generateQuantityOptions($product['quantity']) . '
                </select>
                <button class="btx-red" id="buy">Buy Now</button>
                <button class="btx-red" onclick="addToCart(' . htmlspecialchars($product['variation_id']) . ')" ' . ($product['quantity'] > 0 ? '' : 'disabled') .'>Add To Cart</button>
            </div>
        </div>
    </div>
</div>
';
}
?>