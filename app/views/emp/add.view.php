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
.container {
    width: 96%;
    margin: auto;
}
.appForm {
    width: 100%;
    float:left; 
}
form {
    width: 400px;
    margin: 50px auto;
    display: block;
    background-color: #ccc;
    padding: 20px;
    border: 2px solid #888;

}
form table {
    width: 100%;
    position: relative;
}
form table tr td h2 {
    position: absolute;
    text-align: center;
    top: -50px;
    padding: 7px 20px;
    font-size: 16px;
    background: #555;
    color: aliceblue;
    box-shadow: 0 0 0px 3px #ccc, 0 0 0px 5px #888
}

form table tr td input, form table tr td select {
    display: block;
    margin-bottom: 10px;;
    font-size: 16px;
    padding: 8px 16px;
    width: 100%;
    background: #eee
}
form table tr td input:focus {
    box-shadow: 0 0 2px #000;
    background-color: #fff;
}
form table tr td input[type=submit] {
    background-color: #728b72;
    color: aliceblue;
    font-size: 24px;
    font-weight: bold
}
form table tr td input[type=submit]:hover {
    background-color: #080;
}
::placeholder {
    color: #aaa
}

</style>

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
                    <td><input required type="text" name="name" max="50" placeholder="User's Name"></td>
                </tr>
                <tr>
                    <td><input required type="number" name="age" min="24" max="50" step="1" placeholder="User's Age"></td>
                </tr>
                <tr>
                    <td><input required type="text" name="address" max="50" placeholder="User's address"></td>
                </tr>
                <tr>
                    <td><input required type="number" name="salary" min="1500" max="29999" step="1"  placeholder="User's Salary"></td>
                </tr>
                <tr>
                    <td><input required type="number" name="tax" min="0.5" max="3.0" step="0.01" placeholder="User's Tax (%)"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="save" value="Save"></td>
                </tr>
            </table>
        </form>
    </div>
</div>