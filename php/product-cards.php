<?php
include 'connexion.php';

$category = isset($category) ? $category : null;

$sql = "
SELECT 
    p.product_id,
    p.name AS product_name,
    p.company,
    p.description,
    pv.variation_id, 
    pv.price,
    pv.color,
    pv.quantity, -- Include the quantity field
    pi.image_url
FROM products p
JOIN product_variation pv ON p.product_id = pv.product_id
LEFT JOIN product_images pi ON pv.variation_id = pi.variation_id
WHERE pv.variation_id IN (
    SELECT MIN(pv2.variation_id)
    FROM product_variation pv2
    WHERE pv2.product_id = p.product_id
    GROUP BY pv2.color
)";

if ($category) {
    $sql .= " AND p.category = '" . $conn->real_escape_string($category) . "'";
}

$sql .= " LIMIT 6";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        echo '<div class="product-card">
        <div><img src="../' . htmlspecialchars($product['image_url']) . '" alt=""></div>
        <div class="product-card-summary">
            <h3>' . htmlspecialchars($product['company']) . ' || ' . htmlspecialchars($product['product_name']) . ' (' . strtoupper(substr(htmlspecialchars($product['color']), 0, 3)) . ')</h3>
            <p>' . htmlspecialchars($product['description']) . '</p>
            <div>';

        if (!$category) {
            echo '<p class="promo" style="color: red;">' . number_format($product['price'], 2) . ' TND</p>
                <div class="button-holder">
                    <p class="price">' . number_format($product['price'] * 0.9, 2) . ' TND</p>
                    <button class="btx-add" onclick="addToCart(' . htmlspecialchars($product['variation_id']) . ')" ' . ($product['quantity'] > 0 ? '' : 'disabled') . '>Add to cart</button>
                </div>
            </div>
        </div>
        </div>';
        } else {
            echo '<div class="button-holder">
                    <p class="price">' . number_format($product['price'], 2) . ' TND</p>
                    <button class="btx-add" onclick="addToCart(' . htmlspecialchars($product['variation_id']) . ')" ' . ($product['quantity'] > 0 ? '' : 'disabled') . '>Add to cart</button>
                </div>
            </div>
        </div>
        </div>';
        }
    }
} else {
    echo "No products found.";
}

$conn->close();
?>