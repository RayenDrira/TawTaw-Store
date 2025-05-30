<?php require '..\php\connexion.php'; ?>
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
            <form method="POST" action="..\php\base-signup.php">
                <input type="email" name="email" placeholder="Email or Phone">
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="confirm_password" placeholder="Confirm Password">
                <button type="submit" class="btx-red">Sign up</button>
                <div class="or">
                    <hr>Or
                    <hr>
                </div>
                <button class="btx-blue-reverse"><img src="">Sign in with google</button>
                <p id="new">Have An Account &nbsp; <a href="login.php"><span>Log In</span></a>
                </p>
            </form>
        </div>
    </div>
    <footer>
        <div class="line"></div>
        <p>© 2025 [TawTaw Store]. All rights reserved."</p>
    </footer>
</body>
<script src="..\JS\control-signup.js"></script>
</html>
<?php $conn->close(); ?>