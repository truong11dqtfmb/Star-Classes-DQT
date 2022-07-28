<?php
session_start();
include('../Database/config.php');
define('VER', '2.0');
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

<body>
	<?php
	$er_ps = $er_ph = $er_email = $mail = $password = $phone = '';
	$valid = true;

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

		$mail          = htmlspecialchars($_POST['mail']);
		$password      = htmlspecialchars($_POST['password']);
		$phone         = htmlspecialchars($_POST['phone']);

		if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			$er_email .= '<p style="color: red;">Email cần nhập đúng định dạng</p>';
			$valid = false;
		}
		// if (!preg_match('/^[_a-z0-9-]+(/.[_a-z0-9-]+)*@[a-z0-9-]+(/.[a-z0-9-]+)*(/.[a-z]{2,3})$/',$mail)) {
		//     $er_email .= '<p style="color: red;">Email Invalid</p>';
		//     $valid = false;
		// }
		if (!preg_match("/^0[0-9]{9}$/", $phone)) {
			$er_ph .= '<p style="color: red;">Số điện thoại cần nhập đúng định dạng</p>';
			$valid = false;
		}

		if (!preg_match('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $password)) {
			$er_ps .= '<p style="color: red;">Mật khẩu cần ít nhất 8 kí tự</br>Mật khẩu cần ít nhất 1 số, 1 chữ hoa, 1 chữ thường, 1 kí tự đặc biệt!</p>';
			$valid = false;
		}

		if ($valid == true) {
			$password = sha1($password);
			$sql_select = sprintf("SELECT * FROM users WHERE mail = '%s' AND phone = '%s' AND pass = '%s'", $mail, $phone, $password);
			$result_select = $con->query($sql_select);
			if ($result_select->num_rows > 0) {
				$_SESSION['mail']  = $mail;
				$_SESSION['phone'] = $phone;
				// echo $_SESSION['mail'];
				// echo $_SESSION['phone'];
				header('Location: index.php');
				return;
			} else {
				echo "<p style='color: red;'>Lỗi Đăng nhập: Email, Số điện thoại hoặc Mật khẩu!</p>";
			}
		}
	}
	?>
	<!-- Main -->
	<main class="main margintop">
		<div class="container">
			<div class="account-page">
				<div class="thumbnail">
					<div class="m-5">
						<h2 class="text-center">ĐĂNG NHẬP</h2>
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
							<div class="form-group text-center">
								<input class="btn btn-primary btn-block" type="submit" name="submit" value="ĐĂNG NHẬP"></input>
								<input class="btn btn-primary btn-block" type="reset" value="NHẬP LẠI"></input>

							</div>
							<div class="form-group text-center">
								<a href="Dang_ky.php">Bạn chưa có tài khoản? Đăng kí mới</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>

</body>

</html>