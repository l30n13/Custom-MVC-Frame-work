<h1>User : Edit</h1>

<form method="post" action="<?php echo URL; ?>user/editSave/<?php echo $this->user['id']; ?>">
    <label>Login</label><input type="text" name="login" value="<?php echo $this->user['login']; ?>"/><br>
    <label>Password</label><input type="password" name="password"/><br>
    <label>Role</label>
    <select name="role">
        <option value="Default" <?php if($this->user['role'] == 'default') echo 'selected'; ?> >Default</option>
        <option value="Admin" <?php if($this->user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
    </select><br>
    <label>&nbsp;</label><input type="submit"/>
</form>