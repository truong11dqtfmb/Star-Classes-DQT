<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <title>LOGIN</title>
    <style type="text/css">
        .margintop {
            margin-top: 80px;
        }
    </style>
</head>

<?php
include_once('../../Database/config.php');
session_start();
$er_email =  $er_ph = $er_ps = '';
$valid = true;
if (isset($_POST['submit'])) {
    if (empty($_POST['mail']) || $_POST['mail'] == '') {
        $er_email .= '<p style="color: red;">Email required</p>';
        $valid = false;
    }
    if (empty($_POST['phone']) || $_POST['phone'] == '') {
        $er_ph .= '<p style="color: red;">Phone number required</p>';
        $valid = false;
    }
    if (empty($_POST['password']) || $_POST['password'] == '') {
        $er_ps .= '<p style="color: red;">Password required</p>';
        $valid = false;
    }

    $mail          = htmlspecialchars($_POST['mail']);
    $phone         = htmlspecialchars($_POST['phone']);
    $password      = htmlspecialchars($_POST['password']);


    if ($valid == true) {
        $password = sha1($password);
        $sql_select = sprintf("SELECT * FROM admin WHERE mail = '%s' AND phone = '%s' AND pass = '%s'", $mail, $phone, $password);
        $result_select = $con->query($sql_select);
        if ($result_select->num_rows > 0) {
            $_SESSION['mail_admin']  = $mail;
            $_SESSION['phone_admin'] = $phone;
            header('Location: ../index.php');
            return;
        } else {
            echo "<p style='color: red;'>Error: Email, Phone Number or Password!</p>";
        }
    }
}
?>

<body>
    <!-- Main -->
    <main class="main margintop">
        <div class="container">

            <h2 class="text-center text-secondary">LOGIN</h2>
            <div class="container" style="width: 500px; margin: auto;">
                <form action="" method="post" enctype="multipart/form">
                    <div class="form-group">
                        <label>Email: </label>
                        <input type="email" name="mail" placeholder="Email" class="form-control" required>
                        <?= $er_email ?>
                    </div>
                    <div class="form-group">
                        <label>Phone Number: </label>
                        <input type="text" name="phone" placeholder="Phone Number" class="form-control" required>
                        <?= $er_ph ?>
                    </div>
                    <div class="form-group">
                        <label>Password: </label>
                        <input type="password" name="password" placeholder="Password" class="form-control" required>
                        <?= $er_ps ?>
                    </div>
                    <input class="btn btn-primary btn-block" type="submit" name="submit" value="LOGIN"></input>
                    <div class="text-center">
                        <a href="register.php">Bạn chưa có tài khoản? Đăng ký</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>

</html>