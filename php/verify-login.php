<?php
session_start(); // Start the session at the very beginning
require 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Escape user input to prevent SQL injection
    $email = $conn->real_escape_string($email);

    // Query to check if the email exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify the password (direct comparison)
        if ($password === $user['password']) {
            // Store user information in the session
            $_SESSION['user_id'] = $user['user_id']; // Assuming 'id' is the primary key in the 'users' table
            $_SESSION['user_email'] = $user['email'];
            header("Location: ../html/s-index.php"); // Redirect to the home page
            exit();

        } else {
            // Incorrect password
            echo "<script>
                    alert('Incorrect password. Please try again.');
                    window.location.href = '../html/login.php';
                  </script>";
            exit();
        }
    } else {
        // Email not found
        echo "<script>
                alert('No account found with this email. Please sign up.');
                window.location.href = '../html/signup.php';
              </script>";
        exit();
    }
}

// Close the database connection
$conn->close();
?>