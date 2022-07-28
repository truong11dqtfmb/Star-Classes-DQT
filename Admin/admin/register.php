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
    <style type="text/css">
        .margintop {
            margin-top: 80px;
        }
    </style>
</head>
<?php
include('../../Database/config.php');
$er_name = $er_ps = $er_ph = $er_exists = $er_email = '';
$valid = true;

if (isset($_POST['submit'])) {
    //Check error:
    if (empty($_POST['fullname']) || $_POST['fullname'] == '') {
        $er_name .= '<p style="color: red;">Fullname required</p>';
        $valid = false;
    }

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


    $fullname      = htmlspecialchars($_POST['fullname']);
    $mail          = htmlspecialchars($_POST['mail']);
    $password      = htmlspecialchars($_POST['password']);
    $phone         = htmlspecialchars($_POST['phone']);

    //Check exists:
    $sql_exists = sprintf("SELECT * FROM admin WHERE phone = '%s' or mail = '%s'", $phone, $mail);
    $result_exists = $con->query($sql_exists);

    if ($result_exists->num_rows > 0) {
        $er_exists .= "<p style='color: red;'>Email or Phone Number already exists</p>";
        $valid = false;
    }

    //Insert:
    if ($valid == true) {
        $password = sha1($password);
        $sql_insert = sprintf("INSERT INTO admin(fullname,mail,phone,pass) VALUES('%s','%s','%s','%s')", $fullname, $mail, $phone, $password);
        $result_insert = $con->query($sql_insert);
        if ($result_insert) { ?>

            <body>
                <p>Register Successfully!</p>
                <p>fullname: <?= $fullname ?></p>
                <p>Email: <?= $mail ?></p>
                <p>Phone number: <?= $phone ?></p>
                <a href="login.php">Login</a>
            </body>
<?php
            return;
        }
    }
}
?>

<body>

    <!-- Main -->
    <main class="main margintop">
        <div class="container">

            <h2 class="text-center text-secondary">REGISTER</h2>
            <div class="container" style="width: 500px; margin: auto;">
                <form action="" method="post" enctype="multipart/form">
                    <div class="form-group">
                        <label>Fullname: </label>
                        <input type="text" name="fullname" placeholder="Fullname" class="form-control" required>
                        <?= $er_name ?>
                    </div>
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
                    <input class="btn btn-primary btn-block" type="submit" name="submit" value="REGISTER"></input>
                    <div class="text-center">
                        <a href="login.php">Bạn đã có tài khoản? Đăng nhập</a>
                    </div>
                    <?= $er_exists ?>
                </form>
            </div>
        </div>
    </main>
</body>

</html>