<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test page</title>
</head>
<body>
    <form action="" method="post">
        <h2>Passwords confirmation checking</h2>
        <input type="password" name="password" placeholder="Password" required> </br>
        <input type="password" name="cpassword" placeholder="Configrm password" required> </br>
        <input type="submit" value="Check">
    </form>
    <?php
    $password = stripslashes($_REQUEST['password']);
    $cpassword = stripslashes($_REQUEST['cpassword']);

    if ($password != $cpassword) {
        echo "<script> alert('The passwords are different')</script>";

    } else {
        echo "<script> alert('The passwords are the same.')</script>";
        echo "Well done!!!";
    }
    ?>
</body>
</html>