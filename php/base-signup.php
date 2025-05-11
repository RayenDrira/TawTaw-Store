<?php

require 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the HTML form
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>
                alert('Passwords do not match!');
                window.location.href = '../html/signup.php';
              </script>";
        exit();
    } else {
        // Escape user input to prevent SQL injection
        $email = $conn->real_escape_string($email);

        // Check if the email already exists
        $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($check_email_sql);

        if ($result->num_rows > 0) {
            // Email already exists
            echo "<script>
                    alert('An account with this email already exists. Please log in or reset your password.');
                    window.location.href = '../html/signup.php';
                  </script>";
            exit();
        } else {
            // Insert plain text password into the database
            $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        alert('Signup successful! Redirecting to login page...');
                        window.location.href = '../html/login.php';
                      </script>";
                exit();
            } else {
                // Handle database insertion error
                echo "<script>
                        alert('Error: Unable to complete signup. Please try again later.');
                        window.location.href = '../html/signup.php';
                      </script>";
                exit();
            }
        }
    }
}

// Close the database connection
$conn->close();
?>