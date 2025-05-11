<?php
session_start();
include '../php/connexion.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$user_id = $_SESSION['user_id'];

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['variation_id'])) {
    echo json_encode(['success' => false, 'message' => 'Variation ID is required.']);
    exit;
}

$variation_id = intval($data['variation_id']);

$sql = "SELECT * FROM product_variation WHERE variation_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $variation_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid variation ID.']);
    exit;
}

$sql = "SELECT * FROM cart WHERE user_id = ? AND variation_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $user_id, $variation_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $sql = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND variation_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $user_id, $variation_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Cart updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update cart.']);
    }
} else {
    $sql = "INSERT INTO cart (user_id, variation_id, quantity) VALUES (?, ?, 1)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $user_id, $variation_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Item added to cart successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add item to cart.']);
    }
}

$stmt->close();
$conn->close();
?>