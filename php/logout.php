<?php
session_start();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}
session_destroy();
echo "<script>
    if (alert('You have been logged out. Please come back!!!!')) {
        window.location.href = '../html/index.php';
    } else {
        window.location.href = '../html/index.php';
    }
</script>";
exit();
?>