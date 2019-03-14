<?php
if (isset($_POST['save'])) {
    include ('init.php');
    $s = 5;
    echo $s;
} else {
    echo 'no submit';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="includes/css/style.css">
</head>
<body>
    <form method="post">
        <h1>Log In To Casher</h1>
        <input type="text" placeholder="Name" name="name" autocomplete="off">
        <input type="password" placeholder="Password" name="pass" autocomplete="off">
        <input type="submit" name="save" value="Log In">
    </form>
    <script type="text/javascript">
        document.body.style.height = window.innerHeight;
    </script>
</body>
</html>