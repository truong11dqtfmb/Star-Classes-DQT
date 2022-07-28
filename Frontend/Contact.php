<?php
include_once('_header.php');
?>
<?php

//validate
$er_name = $er_ad = $er_ph = $er_email = $er_notes = $success = '';
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

  if (empty($_POST['adress']) || $_POST['adress'] == '') {
    $er_ad .= '<p style="color: red;">Address number required</p>';
    $valid = false;
  }

  if (empty($_POST['notes']) || $_POST['notes'] == '') {
    $er_notes .= '<p style="color: red;">Content required</p>';
    $valid = false;
  }


  $fullname = htmlspecialchars($_POST['fullname']);
  $mail = htmlspecialchars($_POST['mail']);
  $phone = htmlspecialchars($_POST['phone']);
  $adress = htmlspecialchars($_POST['adress']);
  $notes = htmlspecialchars($_POST['notes']);

  $sql_insert = sprintf(
    "INSERT INTO feedback (fullname,mail,phone,adress,notes,create_at) 
    VALUES('%s','%s','%s','%s','%s','%s')",
    $fullname,
    $mail,
    $phone,
    $adress,
    $notes,
    date('Y-m-d H:i:s')
  );
  $query = mysqli_query($con, $sql_insert);
  $success = "<h4 style='color: green;'>Bạn đã gửi liên hệ đến Star Classes thành công</h4>";
}
?>

<!-- Main -->
<div class="container margintop">
  <ol class="breadcrumb">
    <li><a href="index.php">Trang chủ</a></li>
    <li class="active"><a href="">Liên hệ</a></li>
  </ol>
  <div class="about row">
    <div class="col-md-6 text-justify">
      <h2>Thông tin liên hệ</h2>
      <p>Tên công ty: Công ty TNHH Giáo Dục Star Classes Việt Nam</p>
      <p>Địa chỉ email: quoctruong11tv@gmail.com</p>
      <p>Số điện thoại: 0342162155</p>
      <p>Địa điểm trụ sở: 4 Mặt tiền Hồ Gươm</p>
    </div>
    <div class="col-md-6 text-justify">
      <h2>LIÊN HỆ STAR CLASSES</h2>
      <form action="" method="post" enctype="multipart/form">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Họ và tên</label>
              <input class="form-control" type="text" placeholder="Họ và tên" name="fullname" required>
              </input>
              <?= $er_name ?>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input class="form-control" type="text" placeholder="Email" name="mail" required>
              </input>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Phone</label>
              <input class="form-control" type="text" placeholder="Số điện thoại" name="phone" required>
              </input>
            </div>
            <div class="form-group">
              <label>Địa chỉ</label>
              <input class="form-control" type="text" placeholder="Địa chỉ" name="adress" required>
              </input>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Nội dung</label>
              <textarea class="form-control" rows="10" required name="notes" placeholder="Nội dung"></textarea>
            </div>
          </div>
        </div>
        <input class="btn btn-primary btn-block" type="submit" value="SUBMIT" name="submit"></input>
        <input class="btn btn-primary btn-block" type="reset" value="NHẬP LẠI"></input>

        <?php echo $success; ?>
      </form>
    </div>
  </div>
  <!-- Map -->
  <div class="col-md-12">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3686.506356074637!2d105.85005821498653!3d21.02773318599886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac69f861af3f%3A0x331250d72cd2fa28!2sSword%20Lake!5e0!3m2!1sen!2s!4v1656830709363!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
</div>
</div>

<?php
include_once('_footer.php');
?>