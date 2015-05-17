<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Edit Demo Page</title>
</head>
<body>

<form action="<?php echo URL; ?>demo_page/editIt" method="post">
    <label>This is heading</label><input type="text" value="<?php echo $this->heading; ?>" name="heading"/><br>
    <label>This is paragraph</label><textarea name="paragraph"><?php echo $this->paragraph; ?></textarea><br>
    <button type="submit">Edit</button>
</form>
</body>
</html>