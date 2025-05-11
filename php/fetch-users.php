<?php
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Email</th><th>Password</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['email'] . "</td><td>" . $row['password'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No users found in the database.</p>";
}

?>