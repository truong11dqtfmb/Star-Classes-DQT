<?php
include_once("_header.php");
session_start();

include_once("../Database/config.php");
?>


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
    <link rel="stylesheet" type="text/css" href="style.css?ver=<?php echo VER; ?>">
</head>
<?php
$er_ps = $er_ph = $er_exists = $er_email =  $er_nps = '';
$mail = $password = $phone = $new_password = '';
$valid = true;
if (isset($_SESSION['mail']) && isset($_SESSION['phone'])) {
    if (isset($_POST['submit'])) {
        //Check error:
        if (empty($_POST['mail']) || $_POST['mail'] == '') {
            $er_email .= '<p style="color: red;">Vui lòng nhập đầy đủ Email</p>';
            $valid = false;
        }

        if (empty($_POST['phone']) || $_POST['phone'] == '') {
            $er_ph .= '<p style="color: red;">Vui lòng nhập đầy đủ Số điện thoại</p>';
            $valid = false;
        }

        if (empty($_POST['password']) || $_POST['password'] == '') {
            $er_ps .= '<p style="color: red;">Vui lòng nhập đầy đủ Mật khẩu</p>';
            $valid = false;
        }
        if (empty($_POST['new_password']) || $_POST['new_password'] == '') {
            $er_nps .= '<p style="color: red;">Vui lòng nhập đầy đủ Mật khẩu Mới</p>';
            $valid = false;
        }
        $mail          = htmlspecialchars($_POST['mail']);
        $password      = htmlspecialchars($_POST['password']);
        $new_password      = htmlspecialchars($_POST['new_password']);
        $phone         = htmlspecialchars($_POST['phone']);

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $er_email .= '<p style="color: red;">Email cần nhập đúng định dạng</p>';
            $valid = false;
        }

        if (!preg_match("/^0[0-9]{9}$/", $phone)) {
            $er_ph .= '<p style="color: red;">Số điện thoại cần nhập đúng định dạng</p>';
            $valid = false;
        }

        if (!preg_match('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $password)) {
            $er_ps .= '<p style="color: red;">Mật khẩu cần ít nhất 8 kí tự</br>Mật khẩu cần ít nhất 1 số, 1 chữ hoa, 1 chữ thường, 1 kí tự đặc biệt!</p>';
            $valid = false;
        }
        if (!preg_match('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $new_password)) {
            $er_nps .= '<p style="color: red;">Mật khẩu Mới cần ít nhất 8 kí tự</br>Mật khẩu cần ít nhất 1 số, 1 chữ hoa, 1 chữ thường, 1 kí tự đặc biệt!</p>';
            $valid = false;
        }


        //Check exists:
        if ($valid == true) {
            $sql_select = sprintf("SELECT * FROM users WHERE phone = '%s' AND mail = '%s'", $phone, $mail);
            $result_select = $con->query($sql_select);
            if ($result_select->num_rows > 0) {
                $password = sha1($password);
                $new_password = sha1($new_password);

                $sql_update = sprintf("UPDATE users SET pass = '%s' WHERE phone = '%s' AND  mail = '%s' AND pass = '%s'", $new_password, $phone, $mail, $password);
                $result_update = $con->query($sql_update);
                if ($result_update) {
?>
                    <h1>Bạn đã thay đổi mật khẩu thành công</h1>
                    <a href="Dang_nhap.php">Đăng nhập lại</a>
<?php

                    return;
                }
            } else {
                $er_ch .= "<p style='color: red;'>Lỗi: Sai Email, Số điện thoại hoặc Mật khẩu !</p>";
            }
        }
    }
} else {
    header('Location: index.php');
}
?>

<body>
    <!-- Main -->
    <main class="main margintop">
        <div class="container">
            <div class="account-page">
                <div class="thumbnail">
                    <div class="m-5">
                        <h2 class="text-center text-secondary">ĐỔI MẬT KHẨU</h2>
                        <form action="" method="post" enctype="multipart/form">
                            <div class="form-group">
                                <label>Email: </label>
                                <input type="email" name="mail" placeholder="Email" class="form-control" value="<?php echo $mail; ?>">
                                <?= $er_email ?>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại: </label>
                                <input type="text" name="phone" placeholder="Số điện thoại" class="form-control" value="<?php echo $phone; ?>">
                                <?= $er_ph ?>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu: </label>
                                <input type="password" name="password" placeholder="Mật khẩu" class="form-control" value="<?php echo $password; ?>">
                                <?= $er_ps ?>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu: </label>
                                <input type="password" name="new_password" placeholder="Mật khẩu Mới" class="form-control" value="<?php echo $new_password; ?>">
                                <?= $er_nps ?>
                            </div>
                            <input class="btn btn-primary btn-block" type="submit" name="submit" value="ĐỔI MẬT KHẨU"></input>
                            <div class="text-center">
                                <a href="Dang_nhap.php">Bạn đã có tài khoản? Đăng nhập</a>
                            </div>
                            <div class="text-center">
                                <a href="Dang_ky.php">Bạn chưa có tài khoản? Đăng ký</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include_once("_footer.php");
    ?>