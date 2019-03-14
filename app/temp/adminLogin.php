<?php
if (isset($_POST['save'])) {
    include('init.php');
    session_start();
    
    $userName = $_POST['userName'];
    $userPass = $_POST['userPass'];
    $cryptPass = md5($userPass);
    $sql = "SELECT * FROM appUsers WHERE userName = '$userName'";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    if (md5($userPass) === $result['userPass']) {
        $sessionUser = '';
        $userUCName = explode(' ', $result['userName']);
        for ($i = 0; $i < count($userUCName); $i++) {
            $sessionUser .= ucfirst($userUCName[$i]) . ' ';
        }
        $_SESSION['userName'] = trim($sessionUser);
        session_write_close();
        header("location:index.php");
        die();
    } else {
        $_SESSION['error'] = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="includes/css/style.css">
</head>
<body style="display: flex">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <h1>Log In To Casher</h1>
        <input type="text" placeholder="Name" name="userName" autocomplete="off">
        <input type="password" placeholder="Password" name="userPass" autocomplete="off">
        <input type="submit" name="save" value="Log In">
        <?= isset($_SESSION['$error']) ? $_SESSION['$error'] : ''; ?>
    </form>
    <script type="text/javascript">
        document.body.style.height = window.innerHeight;
        console.log(window.innerHeight)
    </script>
</body>
</html>