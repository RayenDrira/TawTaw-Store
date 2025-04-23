<?php
// Include the database connection
require 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Check if the email already exists
        $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($check_email_sql);

        if ($result->num_rows > 0) {
            // Email already exists
            echo "<script>alert('An account with this email already exists.');</script>";
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert data into the database
            $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Signup successful!');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    // Close the connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\form.css">
    <link rel="stylesheet" href="..\css\button.css">
    <title>TawTaw\signup</title>
</head>

<body>
    <header>
        <h1>TawTaw Store</h1>
        <div class="line"></div>
    </header>
    <div class="container">
        <div class="glassy-card">
            <h1>Sign up</h1>
            <p>Empowering the Future with Technology</p>
            <form method="POST" action="">
                <input type="email" name="email" placeholder="Email or Phone" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit" class="btx-red">Sign up</button>
                <div class="or">
                    <hr>
                    Or
                    <hr>
                </div>
                <button class="btx-blue-reverse"><img src="">Sign in with google</button>
                <p id="new">Have An Account &nbsp; <a href="login.html"><span>Log In</span></a>
                </p>
            </form>
        </div>
    </div>
    <footer>
        <div class="line"></div>
        <p>© 2025 [TawTaw Store]. All rights reserved."</p>
    </footer>
</body>

</html>