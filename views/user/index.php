<h1>User</h1>

<form method="post" action="<?php echo URL; ?>user/create">
    <label>Login</label><input type="text" name="login"/><br>
    <label>Password</label><input type="password" name="password"/><br>
    <label>Role</label>
    <select name="role">
        <option value="Default">Default</option>
        <option value="Admin">Admin</option>
    </select><br>
    <label>&nbsp;</label><input type="submit"/>
</form>
<hr>
<table>

    <?php

    foreach ($this->userList as $key => $value) {
        echo '<tr>';
        echo '<td>' . $value['id'] . '</td>';
        echo '<td>' . $value['login'] . '</td>';
        echo '<td>' . $value['role'] . '</td>';
        echo '<td><a href="' . URL . 'user/edit/' . $value['id'] . '">Edit</a> <a href="' . URL . 'user/delete/' . $value['id'] . '">Delete</a> </td>';
        echo '</tr>';
    }
    //print_r($this->userList);
    ?>
</table>