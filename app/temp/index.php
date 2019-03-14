<?php
session_start();
include('../init.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="includes/css/style.css">
</head>
<body>
<?php
if (isset($_SESSION['userName'])) {
?>
    <header>
        <div class="container">
            <h1>Welcome <?= $_SESSION['userName']?> to your application control Panel.</h1>
        </div>
    </header>
    <div class="contents">
        <aside>
            <ul>
                <li><a href="includes/app_views/categories.php?p=<?= getPosOf(strtolower($_SESSION['userName']));?>">Category</a></li>
                <li>Meals</li>
                <li>Users</li>
                <li>Sales</li>
                <li>Customers</li>
                <li>Expenses</li>
                <li>Offers</li>
                <li><a href="profile.php?id=<?= getIdOf(strtolower($_SESSION['userName']));;?>">Profile</a></li>
            </ul>
        </aside>
        <div class="content-body">
           <div class="row">
               <div class="col col-4">
                    <div class="card">
                        <div class="card-content">
                            Today's Requests
                        </div>
                        <div class="card-footer">
                            98
                        </div>
                    </div><!--card-->
                </div><!--col-->
               <div class="col col-4">
                    <div class="card">
                        <div class="card-content">
                            Today's Sales
                        </div>
                        <div class="card-footer">
                            98
                        </div>
                    </div><!--card-->
                </div><!--col-->
               <div class="col col-4">
                    <div class="card">
                        <div class="card-content">
                            Today's Customers
                        </div>
                        <div class="card-footer">
                            98
                        </div>
                    </div><!--card-->
                </div><!--col-->
               <div class="col col-4">
                    <div class="card">
                        <div class="card-content">
                            Today's Meals
                        </div>
                        <div class="card-footer">
                            98
                        </div>
                    </div><!--card-->
                </div><!--col-->
            </div>
        </div>
    </div>
<?php
} else { ?>
    <a href="adminLogin.php">Log In</a>
    
<?php
    }
?>
    <footer>
        Copyrights &copy; Atef Akl <sup>TM</sup>
        <h5>2018 - 2022</h5>
    </footer>
</body>
</html>