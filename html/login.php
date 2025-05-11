<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\form.css">
    <link rel="stylesheet" href="..\css\button.css">
    <script src="..\JS\control-login.js"></script>
    <title>TawTaw\login</title>
</head>

<body>
    <header>
        <h1>TawTaw Store</h1>
        <div class="line"></div>
    </header>
    <div class="container">
        <div class="glassy-card">
            <h1>Log in</h1>
            <p>Empowering the Future with Technology</p>
            <form method="POST" action="../php/verify-login.php">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <a href="">forgot password</a>
                <button type="submit" class="btx-red">Sign in</button>
                <div class="or">
                    <hr>
                    Or
                    <hr>
                </div>
                <button class="btx-blue-reverse"><img src="">Sign in with google</button>
                <p id="new">New to TawTaw &nbsp; <a href="signup.php"><span>Join Now!</span></a></p>
            </form>
        </div>
    </div>
    <footer>
        <div class="line"></div>
        <p>© 2025 [TawTaw Store]. All rights reserved."</p>
    </footer>
</body>

</html>