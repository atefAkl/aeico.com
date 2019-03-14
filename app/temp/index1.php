<?php
require ('init.php');
include ('abstract.model.php');
require ('user.class.php');
//include ('user.class.php');

    if (isset($_POST['save'])) {
        $userFull   = filter_input(INPUT_POST, 'userFull', FILTER_SANITIZE_STRING);
        $userName   = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
        $userMail   = filter_input(INPUT_POST, 'userMail', FILTER_SANITIZE_EMAIL);
        $userPass   = md5(filter_input(INPUT_POST, 'userPass', FILTER_SANITIZE_STRING));
        $userDOB    = filter_input(INPUT_POST, 'userDOB', FILTER_SANITIZE_NUMBER_INT);
        $userPos    = filter_input(INPUT_POST, 'userPos', FILTER_SANITIZE_NUMBER_INT);
        $thisUser   = new User($userFull, $userName, $userMail, $userPass, $userDOB, $userPos);
        try {
            $thisUser->save();
            $msg = "User $userFull inserted successfully.";
        } catch (PDOException $e) {
            $msg = "Failed to save user";
        }
    }
    if (isset($_GET['a']) && $_GET['a'] === 'edt' && isset($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $user = User::getByPK($id);
    }

    if (isset($_GET['a']) && $_GET['a'] === 'dlet' && isset($_GET['id'])) {
        $id = filter_var(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $user = User::getByPK($id);
        if ($user->delete()) {
            $msg = "User Deleted successfully.";
        } else {
            $msg = "Failed to delete user";
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
<body>
    <div class="container">
        <div class="appForm">
            <form method="post">
                <table>
                    <tr>
                        <td>
                            <h2>Add New User</h2>
                        </td>
                    </tr>
                    <tr>
                        <td><input required type="text" <?= isset($_GET['a']) && $_GET['a'] == 'edt' ? 'value="' . $user->userFull . '"' : '' ?> name="userFull" max="50" placeholder="User's Full Name"></td>
                    </tr>
                    <tr>
                        <td><input required type="text" <?= isset($_GET['a']) && $_GET['a'] == 'edt' ? 'value="' . $user->userName . '"' : '' ?> name="userName" max="12" placeholder="User's User Name"></td>
                    </tr>
                    <tr>
                        <td><input required type="email" <?= isset($_GET['a']) && $_GET['a'] == 'edt' ? 'value="' . $user->userMail . '"' : '' ?> name="userMail" max="50" placeholder="User's E-mail"></td>
                    </tr>
                    <tr>
                        <td><input required type="password" <?= isset($_GET['a']) && $_GET['a'] == 'edt' ? 'value="' . $user->userPass . '"' : '' ?> name="userPass" max="50" placeholder="User's Password"></td>
                    </tr>
                    <tr>
                        <td><input required type="text" <?= isset($_GET['a']) && $_GET['a'] == 'edt' ? 'value="' . $user->userDOB . '"' : '' ?> name="userDOB"placeholder="User's Birthday" onfocus="this.type='date'" onblur="this.type='text'"></td>
                    </tr>
                    <tr>
                        <td><select required name="userPos" placeholder="User's Possition">
                            <option>Select Possition</option>
                            <option value="1">General Manager</option>
                            <option value="2">Department Manager</option>
                            <option value="3">Master Cheif</option>
                            <option value="4">Cheif Assist</option>
                            <option value="5">Mini Cheif</option>
                            <option value="6">Casher</option>
                            <option value="7">Bus Boy</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="save" value="Save"></td>
                    </tr>
                </table>
                
            </form>
            
                <?php if (isset($msg)) { ?>
                <p class="message">
                <?= $msg ?>
                </p>
                <?php } ?>
            </p>
        </div>
        <div class="appUsers">
            <h2>Casher Users</h2>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Full Name</th>
                    <th>nick name</th>
                    <th>e-mail</th>
                    <th>Possition</th>
                    <th>birth</th>
                    <th>manage</th>
                </tr>
                <?php
                $users = User::getAll();
                if ($users !== false) {
                foreach ($users as $user) { ?>
                <tr>
                    <td><?= $user->userId ?></td>
                    <td><?= $user->userFull ?></td>
                    <td><?= $user->userName ?></td>
                    <td><?= $user->userMail ?></td>
                    <td><?= $user->userPos ?></td>
                    <td><?= $user->userDOB ?></td>
                    <td>
                        <a href="?a=edt&id=<?= $user->userId ?>">Edit</a>
                        <a href="?a=dlet&id=<?= $user->userId ?>"> Del</a>
                    </td>
                </tr>

            <?php }
                } else { ?>
                <tr>
                    <td colspan="7">No users to display</td>
                </tr>
                <?php } ?>
                
                
            </table>
        </div>
    </div>
</body>
</html>