<style type="text/css">
* {
    margin: 0;
    padding: 0;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    font-family: inherit;
    border: none;
    outline: 0;
}
a, a:focus, a:hover, a:visited {
    text-decoration: none;
    color: inherit
}
body {
    background-color: #ddd;
    width: 100%;
    height: 100vh;
    font-family: Arial;
}

.appUsers {
    width: 100%;
    position: relative;
    top: 20px;
}
.appUsers h2 {
    position: absolute;
    width: 200px;
    top: -25px;
    font-size: 16px;
    text-align: center;
    padding: 7px;
    background: #555;
    color: aliceblue;
    left: 10%;
    box-shadow: 0 0 0px 3px #ccc, 0 0 0px 5px #888
}
.appUsers h2.addBtn {
    top: 100%;
    height: 30px;
    left: 90%;
    transform: translateX(-100%);
}
.appUsers table {
    border: 2px double #888;
    width: 90%;
    display: table;
    margin: 30px auto; 
}
.appUsers table tr {
    border-bottom: 1px solid #888;
}

.appUsers table tr td + td, .appUsers table tr th + th {
    border-left: 1px solid #888
}
.appUsers table tr td , .appUsers table tr th {
    padding: 3px 5px;
} 
.appUsers table tr:nth-child(even){
    background: #eee;
    color: #555
}
.appUsers table tr th {
    color: #333;
    padding-top: 14px;
    font-size: 16px;
    background: #888
}
.appUsers table tr td {
    color: #444;
    font-size: 12px;
}
</style>

<div class="appUsers">
    <h2>Casher Users</h2>
    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Age</th>
            <th>Address</th>
            <th>Tax</th>
            <th>Salary</th>
            <th>manage</th>
        </tr>
        <?php
        if ($emps !== false) {
        foreach ($emps as $emp) { ?>
        <tr>
            <td><?= $emp->id ?></td>
            <td><?= $emp->name ?></td>
            <td><?= $emp->age ?></td>
            <td><?= $emp->address ?></td>
            <td><?= $emp->tax ?></td>
            <td><?= $emp->salary ?></td>
            <td>
                <a href="<?= '/emp/edit/' . $emp->id ?>">Edit</a>
                <a href="<?= '/emp/delete/' . $emp->id ?>" onclick="if(!confirm('Are You Sure?')){return false}return true"> Del</a>
            </td>
        </tr>

    <?php  	} /* End of Foreach */
        } else { 

        	?>
        <tr>
            <td colspan="7">No users to display</td>
        </tr>
        <?php } ?>
        
            
    </table>
    <h2 class="addBtn"><a href="add">Add New Employee</a></h2>
</div>
